<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>React Working Test</title>
    <!-- Change how Vite is loaded -->
   
   
</head>
<body>
    @viteReactRefresh
@vite(['resources/js/app.jsx'])
    <div id="app" style="border: 2px dashed red; padding: 20px;">
        <!-- This will be replaced by React -->
        Loading... (If you see this too long, check console)
    </div>
    
    <!-- Add this debug script -->
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            console.log('DOM fully loaded');
            console.log('Vite preamble exists:', 
                !!window.__vite_plugin_react_preamble_installed__);
        });
    </script>
</body>
</html>