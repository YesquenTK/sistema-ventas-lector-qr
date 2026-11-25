# 🛒 Sistema Web de Ventas con Lector QR

Sistema web integral desarrollado para la gestión de ventas, pagos digitales y control de inventario mediante escaneo de códigos QR, implementado durante mis prácticas preprofesionales para la empresa **Representaciones Generales Habel E.I.R.L.**

## 🚀 Funcionalidades principales
* **Punto de Venta (POS) con Lector QR:** Registro y cobro ágil de productos mediante escaneo de códigos QR desde cámara web.
* **Pasarela y Métodos de Pago:** Procesamiento de pagos integrado con **Culqi** (tarjetas) y soporte para pagos con **Yape** y **BCP**.
* **Generación y Envío de Comprobantes:** Creación automática de comprobantes de venta en formato PDF y envío directo al correo electrónico del cliente tras confirmar el pago.
* **Gestión de Inventario y Catálogo:** Control de stock, registro y actualización de productos con carga múltiple de imágenes mediante arrastrar y soltar.
* **Dashboard y Reportes Estadísticos:** Visualización interactiva de métricas en tiempo real (ventas diarias, ingresos mensuales, gráficos de barras, líneas y circulares por categoría).
* **Control de Usuarios y Seguridad:** Acceso diferenciado por roles (Administrador / Vendedor) y consultas seguras a base de datos mediante PDO.

## 🛠️ Tecnologías y librerías utilizadas
* **Backend:** PHP (PDO)
* **Base de Datos:** MySQL (XAMPP)
* **Frontend:** HTML5, CSS3, JavaScript, Bootstrap
* **Librerías e Integraciones:**
  * `culqi-php`: Integración de pasarela de pagos.
  * `FPDF (v1.86)`: Generación dinámica de comprobantes en PDF.
  * `PHPMailer`: Envío automatizado de correos con comprobantes adjuntos.
  * `Chart.js`: Gráficos estadísticos interactivos en el panel administrativo.
  * `Dropzone.js`: Carga interactiva de imágenes de productos.
