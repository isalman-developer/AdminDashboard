// Import jQuery and make it globally available
import $ from 'jquery';
window.jQuery = window.$ = $;

// Set up essential global variables from template data attributes
window.assetsPath = document.documentElement.getAttribute('data-assets-path');
window.templateName = document.documentElement.getAttribute('data-template');

// Global config for charts and components
window.config = {
  colors: {
    primary: '#7367F0',
    secondary: '#82868b',
    success: '#28c76f',
    info: '#00cfe8',
    warning: '#ff9f43',
    danger: '#ea5455',
    dark: '#4b4b4b',
    black: '#000',
    white: '#fff',
    cardColor: '#fff',
    bodyBg: '#f5f5f9',
    bodyColor: '#6f6b7d',
    headingColor: '#5a5a5a',
    textMuted: '#a8aaae',
    borderColor: '#eee'
  },
  colors_label: {
    primary: '#7367f01a',
    secondary: '#82868b1a',
    success: '#28c76f1a',
    info: '#00cfe81a',
    warning: '#ff9f431a',
    danger: '#ea54551a',
    dark: '#4b4b4b1a'
  },
  fontFamily: 'Public Sans',
  enableMenuLocalStorage: true
};

// Import any custom scripts
import './main.js';
import './dashboards-analytics.js';