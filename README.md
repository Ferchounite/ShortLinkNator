# Short Linknator

## Descripción

Short Linknator es un plugin para WordPress que permite acortar las URLs de tus páginas, posts y tipos de contenido personalizado (CPT). Facilita a los usuarios compartir contenido mediante la generación de URLs cortas y únicas. Además, incluye un botón de "Copiar URL" para una rápida y sencilla copia de la URL corta al portapapeles.

### Características

- **Generación Automática de URLs Cortas:** Crea automáticamente una versión corta y única de la URL de cualquier página, post o CPT.
- **Shortcode Personalizable:** Utiliza el shortcode `[short_url_this_page]` en cualquier parte de tu contenido para mostrar la URL corta y un botón de "Copiar URL".
- **Compatibilidad:** Diseñado para ser compatible con otros plugins y evitar conflictos.
- **Seguridad y Optimización:** Implementado con las mejores prácticas de seguridad y optimización de código.
- **Redirección Automática:** Redirige automáticamente las URLs cortas a la URL original correspondiente.
- **Interfaz Atractiva:** Incluye un estilo CSS predeterminado y fácil de personalizar a nivel de código para una presentación visual atractiva y profesional. Puedes acceder al archivo style.css y modificarlo facilmente a tu gusto.

## Cómo Usar

1. **Instalación:** Sube la carpeta `short-linknator` a la carpeta `wp-content/plugins` de tu instalación de WordPress.
2. **Activación:** Activa el plugin desde la sección de plugins en el panel de administración de WordPress.
3. **Uso del Shortcode:** Inserta el shortcode `[short_url_this_page]` en cualquier página, post o CPT para mostrar la URL corta con un botón de "Copiar URL".

### Ejemplo de Uso
```html
[short_url_this_page]
```
Esto mostrará una salida como:

```html
<div class="short-linknator">
    <p>La URL corta para compartir esta página o post es: <strong>https://example.com/uqwhbxbsii</strong></p>
    <button class="short-linknator-copy-btn" onclick="short_linknator_copy_url()">Copiar URL</button>
</div>

```

### Soporte y Actualizaciones
Para soporte, envía un email a fj.ardila09@gmail.com o ingrese a fernandoardila.dev

### Autor
Nombre: Fernando Ardila
Sitio Web: https://fernandoardila.dev
Licencia
GPL2