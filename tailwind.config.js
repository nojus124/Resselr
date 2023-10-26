/** @type {import('tailwindcss').Config} */
export default {
  content: [
	"./resources/**/*.blade.php",
	"./resources/**/*.js",
	"./resources/**/**.vue",
  ],
  theme: {
    extend: {colors: {
        'custom-background1': '#F9F6F4;',
		'custom-textcolor1': '#F23802;',
		'custom-textcolor2': '#107B10;',
		},
	  },
  },
    plugins: [require("daisyui"), require('tailwindcss-animated')],
}

