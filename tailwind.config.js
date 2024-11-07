/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./index.php",
    "./views/**/*.php",
    "./src/**/*.{js,ts,jsx,tsx,php}",
    "./src/assets/**/*.{js,ts,jsx,tsx,php}"
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

