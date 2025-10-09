const fs = require('fs');

// Leer el archivo
const filePath = 'resources/views/admin/inverter/addnew.blade.php';
const content = fs.readFileSync(filePath, 'utf8');

// Reemplazar todos los \n literales por saltos de línea reales
const fixedContent = content.replace(/\\n/g, '\n');

// Escribir el archivo corregido
fs.writeFileSync(filePath, fixedContent, 'utf8');

console.log('✅ Archivo corregido exitosamente - caracteres \\n convertidos a saltos de línea reales');