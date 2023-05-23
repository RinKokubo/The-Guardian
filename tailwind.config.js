/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./resources/**/*.blade.php",
            "./resources/**/*.js",
            "./resources/**/*.vue",],
  theme: {
    extend: {},
    screens: {
      'sp': '0px',
      'desktop': '897px'
    },
  },
  plugins: [],
}

