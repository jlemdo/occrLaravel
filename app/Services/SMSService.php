<?php

namespace App\Services;

use Aws\Sns\SnsClient;
use Aws\Exception\AwsException;
use Illuminate\Support\Facades\Log;

class SMSService
{
    private $snsClient;
    private $enabled;

    public function __construct()
    {
        // Verificar si SMS está habilitado
        $this->enabled = config('services.sms.enabled', false);

        if ($this->enabled) {
            try {
                $this->snsClient = new SnsClient([
                    'version' => 'latest',
                    'region' => config('services.aws.region', 'us-east-2'),
                    'credentials' => [
                        'key' => config('services.aws.key'),
                        'secret' => config('services.aws.secret'),
                    ],
                ]);
            } catch (\Exception $e) {
                Log::error('Error inicializando SNS Client: ' . $e->getMessage());
                $this->enabled = false;
            }
        }
    }

    /**
     * Verificar si el servicio SMS está habilitado
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * Enviar SMS usando AWS SNS
     *
     * @param string $phoneNumber Número de teléfono en formato E.164 (+521234567890)
     * @param string $message Mensaje a enviar
     * @param string $senderId Identificador del remitente (opcional)
     * @return array ['success' => bool, 'message_id' => string|null, 'error' => string|null]
     */
    public function sendSMS($phoneNumber, $message, $senderId = null)
    {
        if (!$this->enabled) {
            Log::warning('SMS deshabilitado. Mensaje no enviado a: ' . $phoneNumber);
            return [
                'success' => false,
                'message_id' => null,
                'error' => 'SMS service is disabled'
            ];
        }

        try {
            // Validar formato de teléfono
            if (!$this->validatePhoneNumber($phoneNumber)) {
                return [
                    'success' => false,
                    'message_id' => null,
                    'error' => 'Invalid phone number format. Use E.164 format (+521234567890)'
                ];
            }

            $params = [
                'Message' => $message,
                'PhoneNumber' => $phoneNumber,
                'MessageAttributes' => [
                    'AWS.SNS.SMS.SMSType' => [
                        'DataType' => 'String',
                        'StringValue' => 'Transactional' // Transactional para OTPs
                    ]
                ]
            ];

            // Agregar Sender ID si está configurado (solo funciona en algunos países)
            if ($senderId) {
                $params['MessageAttributes']['AWS.SNS.SMS.SenderID'] = [
                    'DataType' => 'String',
                    'StringValue' => $senderId
                ];
            }

            $result = $this->snsClient->publish($params);

            Log::info('SMS enviado exitosamente', [
                'phone' => $phoneNumber,
                'message_id' => $result['MessageId']
            ]);

            return [
                'success' => true,
                'message_id' => $result['MessageId'],
                'error' => null
            ];

        } catch (AwsException $e) {
            Log::error('AWS SNS Error: ' . $e->getAwsErrorMessage(), [
                'phone' => $phoneNumber,
                'error_code' => $e->getAwsErrorCode()
            ]);

            return [
                'success' => false,
                'message_id' => null,
                'error' => $e->getAwsErrorMessage()
            ];

        } catch (\Exception $e) {
            Log::error('Error enviando SMS: ' . $e->getMessage(), [
                'phone' => $phoneNumber
            ]);

            return [
                'success' => false,
                'message_id' => null,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Enviar código OTP por SMS
     *
     * @param string $phoneNumber Número de teléfono
     * @param string $otp Código OTP
     * @param string $appName Nombre de la aplicación
     * @return array
     */
    public function sendOTP($phoneNumber, $otp, $appName = 'OCCR Productos')
    {
        $message = "Tu código de verificación para {$appName} es: {$otp}\n\nEste código expira en 10 minutos.\n\nSi no solicitaste este código, ignora este mensaje.";

        return $this->sendSMS(
            $phoneNumber,
            $message,
            config('services.sms.sender_id', 'OCCR')
        );
    }

    /**
     * Validar formato de número de teléfono (E.164)
     *
     * @param string $phoneNumber
     * @return bool
     */
    private function validatePhoneNumber($phoneNumber)
    {
        // Formato E.164: +[código país][número]
        // Ejemplo México: +521234567890 (13 dígitos total)
        return preg_match('/^\+[1-9]\d{1,14}$/', $phoneNumber);
    }

    /**
     * Formatear número de teléfono mexicano a E.164
     *
     * @param string $phoneNumber Número sin formato (10 dígitos)
     * @return string Número en formato E.164
     */
    public static function formatMexicanPhone($phoneNumber)
    {
        // Eliminar cualquier carácter no numérico
        $clean = preg_replace('/\D/', '', $phoneNumber);

        // Si tiene 10 dígitos, agregar código de país México (+52)
        if (strlen($clean) === 10) {
            return '+52' . $clean;
        }

        // Si ya tiene 12 dígitos (52 + 10), agregar +
        if (strlen($clean) === 12 && substr($clean, 0, 2) === '52') {
            return '+' . $clean;
        }

        // Si ya tiene el formato correcto
        if (substr($phoneNumber, 0, 1) === '+') {
            return $phoneNumber;
        }

        return $phoneNumber;
    }

    /**
     * Configurar atributos de SMS en SNS (ejecutar una vez)
     *
     * @return array
     */
    public function configureSNSAttributes()
    {
        if (!$this->enabled) {
            return ['success' => false, 'error' => 'SMS service disabled'];
        }

        try {
            // Configurar tipo de SMS por defecto
            $this->snsClient->setSMSAttributes([
                'attributes' => [
                    'DefaultSMSType' => 'Transactional', // Transactional o Promotional
                    'DefaultSenderID' => config('services.sms.sender_id', 'OCCR'), // No funciona en todos los países
                ]
            ]);

            Log::info('SNS SMS attributes configured successfully');

            return ['success' => true];

        } catch (\Exception $e) {
            Log::error('Error configurando SNS attributes: ' . $e->getMessage());
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
}
