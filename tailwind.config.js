/** @type {import('tailwindcss').Config} */
export default {
  theme: {
    extend: {
      transitionDelay: {
        '2000': '2000ms',
      }
    },
  },
  plugins: [
    require('daisyui'),
  ],
  content: [
    "./resources/**/*.{html,js,vue,blade.css}",
  ],
}