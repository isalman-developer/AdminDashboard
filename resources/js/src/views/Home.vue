<!-- filepath: /home/salman/projects/Rehab/resources/js/src/views/Home.vue -->

<script setup>
// Import ref (makes data reactive - updates automatically)
import { ref } from "vue";

// Create reactive variables
const appName = ref("Rehab Center"); //Makes data reactive (auto-updates UI when changed)
const stack = ref(["Laravel 11", "Vue 3", "Pinia", "Vue Router"]);
</script>

<template>
    <div class="home-container">
        <div class="welcome-card">
            <!-- Display appName variable -->
            <h1 class="title">🚀 Welcome to {{ appName }}</h1>
            <p class="subtitle">Your journey to Vue.js mastery starts here!</p>

            <div class="tech-stack">
                <h2>Tech Stack:</h2>
                <ul>
                    <!-- Loop through stack array and display each item -->
                    <li v-for="tech in stack" :key="tech">✅ {{ tech }}</li>
                </ul>
            </div>

            <div class="next-steps">
                <h3>What we'll build:</h3>
                <p>📋 Task Management System with:</p>
                <ul>
                    <li>User Authentication</li>
                    <li>Project Management</li>
                    <li>Task CRUD Operations</li>
                    <li>Real-time Updates</li>
                    <li>Beautiful UI with Vue</li>
                </ul>
            </div>
        </div>
    </div>
</template>

<style scoped>
/* scoped = styles only apply to this component */

.home-container {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 20px;
}

.welcome-card {
    background: white;
    border-radius: 20px;
    padding: 40px;
    max-width: 600px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
}

.title {
    font-size: 2.5rem;
    color: #2d3748;
    margin-bottom: 10px;
    text-align: center;
}

.subtitle {
    font-size: 1.2rem;
    color: #718096;
    text-align: center;
    margin-bottom: 30px;
}

.tech-stack {
    background: #f7fafc;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 20px;
}

.tech-stack h2 {
    color: #2d3748;
    margin-bottom: 15px;
}

.tech-stack ul {
    list-style: none;
}

.tech-stack li {
    padding: 8px 0;
    font-size: 1.1rem;
    color: #4a5568;
}

.next-steps {
    padding: 20px;
    background: #edf2f7;
    border-radius: 10px;
    border-left: 4px solid #667eea;
}

.next-steps h3 {
    color: #2d3748;
    margin-bottom: 10px;
}

.next-steps p {
    color: #4a5568;
    margin-bottom: 10px;
    font-weight: 600;
}

.next-steps ul {
    list-style: none;
    padding-left: 20px;
}

.next-steps li {
    color: #718096;
    padding: 5px 0;
}

.next-steps li::before {
    content: "→ ";
    color: #667eea;
    font-weight: bold;
}
</style>
