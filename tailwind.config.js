/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./**/*.{html,js,php}",
  ],
  theme: {
    extend: {
      colors: {
        'custom-purple': '#b00acd',
        'blues': '#FF5151F8',
      },
      width: {
        '900': '900px',
      },
      height: {
        '500': '500px',
      },
    },
  },
  plugins: [],
}
