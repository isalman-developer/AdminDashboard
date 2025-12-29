<script setup>
// Import RouterView (displays current page component)
import { RouterView } from "vue-router";
</script>

<template>
    <div id="app">
        <!-- RouterView = displays Home.vue, Login.vue, etc based on URL -->
        <RouterView />
    </div>
</template>

<style>
/* Reset default browser styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Style the body */
body {
    font-family: "Inter", system-ui, -apple-system, sans-serif;
    background-color: #f5f5f5;
}

/* Make app take full screen height */
#app {
    min-height: 100vh;
}
</style>
