/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./**/*.php'],
  theme: {
    extend: {},
  },
  plugins: [require("@tailwindcss/typography"), require("daisyui")],
  daisyui: {
    themes: true,
    darkTheme: "dark",
    logs: false,
  }
}
