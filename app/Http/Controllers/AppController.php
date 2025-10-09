<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AppController extends Controller
{
    /**
     * Muestra la landing page de la app en /app
     */
    public function landingPage()
    {
        return view('app.landing');
    }

    /**
     * API endpoint para verificar versiones de la app
     */
    public function checkVersion(Request $request)
    {
        // Obtener información del request
        $userAgent = $request->header('User-Agent', '');
        $currentVersion = $request->get('version', '1.0.0');
        $platform = $request->get('platform', $this->detectPlatform($userAgent));

        // Configuración de versiones
        $appVersions = [
            'android' => [
                'current_version' => '1.0.0',
                'latest_version' => '1.0.0',
                'download_url' => url('/downloads/sabores-de-origen-v1.0.0.apk'),
                'release_notes' => "🆕 Nuevas funciones:\n• Sistema de actualizaciones automáticas\n• Mejoras en el carrito de compras\n• Optimización de rendimiento\n• Corrección de errores menores",
                'is_critical' => false,
                'min_required_version' => '1.0.0',
                'release_date' => '2024-01-15T10:00:00Z',
                'file_size' => '111.3 MB',
                'checksum' => 'D3460382840CC8477786083722AD4B47482E850CE740B684407812C52A957A3D',
            ],
            'ios' => [
                'current_version' => '1.0.0',
                'latest_version' => '1.0.0',
                'download_url' => 'https://apps.apple.com/mx/app/sabores-de-origen/id123456789',
                'release_notes' => "🆕 Nuevas funciones:\n• Sistema mejorado de notificaciones\n• Mejor integración con Apple Pay\n• Optimización para iOS 17\n• Corrección de errores menores",
                'is_critical' => false,
                'min_required_version' => '1.0.0',
                'release_date' => '2024-01-15T10:00:00Z',
                'file_size' => '111.3 MB',
            ]
        ];

        // Configuración de actualizaciones críticas por versión
        $criticalUpdates = [
            '1.0.0' => false,  // La versión 1.0.0 NO requiere actualización crítica
            '0.9.0' => true,   // Versiones anteriores SÍ requieren actualización crítica
            '0.8.0' => true,
        ];

        try {
            // Log del request para analytics
            \Log::info("App Version Check", [
                'platform' => $platform,
                'current_version' => $currentVersion,
                'user_agent' => $userAgent,
                'ip' => $request->ip()
            ]);

            // Verificar si la plataforma es soportada
            if (!isset($appVersions[$platform])) {
                return response()->json([
                    'error' => true,
                    'message' => 'Plataforma no soportada'
                ], 400);
            }

            $versionInfo = $appVersions[$platform];

            // Determinar si la actualización es crítica
            $isCritical = $criticalUpdates[$currentVersion] ?? false;

            // Verificar si necesita actualización
            $needsUpdate = version_compare($currentVersion, $versionInfo['latest_version'], '<');

            // Preparar respuesta
            $response = [
                'platform' => $platform,
                'current_version' => $currentVersion,
                'latest_version' => $versionInfo['latest_version'],
                'needs_update' => $needsUpdate,
                'download_url' => $versionInfo['download_url'],
                'release_notes' => $versionInfo['release_notes'],
                'is_critical' => $isCritical,
                'min_required_version' => $versionInfo['min_required_version'],
                'release_date' => $versionInfo['release_date'],
                'file_size' => $versionInfo['file_size'],
                'server_time' => now()->toISOString(),
                'check_frequency' => '24h', // Frecuencia recomendada de verificación
            ];

            // Agregar checksum para Android
            if ($platform === 'android' && isset($versionInfo['checksum'])) {
                $response['checksum'] = $versionInfo['checksum'];
            }

            return response()->json($response);

        } catch (\Exception $e) {
            \Log::error("App Version Check Error", [
                'error' => $e->getMessage(),
                'platform' => $platform,
                'version' => $currentVersion
            ]);

            return response()->json([
                'error' => true,
                'message' => 'Error interno del servidor',
                'server_time' => now()->toISOString(),
            ], 500);
        }
    }

    /**
     * Detecta la plataforma basándose en el User-Agent
     */
    private function detectPlatform($userAgent)
    {
        if (stripos($userAgent, 'android') !== false) {
            return 'android';
        }

        if (stripos($userAgent, 'ios') !== false ||
            stripos($userAgent, 'iphone') !== false ||
            stripos($userAgent, 'ipad') !== false) {
            return 'ios';
        }

        return 'android'; // Default
    }
}
