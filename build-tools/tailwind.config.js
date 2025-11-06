const plugin = require('tailwindcss/plugin')
module.exports = {
  corePlugins: {
    // preflight: false,
    container: false
  },
  content: ["./../**/*.{php,}"],
  darkMode: 'dark-mode',
  theme: {
    fontFamily: {
      sans: [ 'Inter', 'sans-serif' ],
      serif: [ 'Helvetica', 'serif' ],
    },
  
    container: {
      center: true,
      padding:{
        DEFAULT: "1rem",
        xs:"0.5rem"
      },
    },
    extend: {
      screens:{
        xs: "421px",
        sm: "576px",
        lg: '992px',
        xl: "1200px",
        '2xl': '1400px'
      },
      colors:{
        primary: '#1d3a53',
        primary_dark  : '#364959',
        secondary:"#ec9648",
        secondary_dark:"#da8334",
        skyblue: "#73d5f5",
        skyblue_dark: "#539db5"
      }
     
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
    plugin(function ({ addComponents, theme }) {
      addComponents({
        '.__sample_class': {
          backgroundColor: theme('colors.white'),
          borderRadius: theme('borderRadius.lg'),
          padding: theme('spacing.6'),
          boxShadow: theme('boxShadow.xl'),
        }
      })
    }),
    function ({ addComponents }) {
      addComponents({
        '.container': {
          maxWidth: '100%',
          marginLeft: 'auto',
          marginRight: 'auto',
          paddingRight: '0.75rem',
          paddingLeft: '0.75rem',
          '@screen sm': {
            maxWidth: '540px',
          },
          '@screen md': {
            maxWidth: '720px',
          },
          '@screen lg': {
            maxWidth: '960px',
          },
          '@screen xl': {
            maxWidth: '1140px',
          },
          '@screen 2xl': {
            maxWidth: '1320px',
          },
        }
      })
      addComponents({
        '.container-fluid': {
          width: '100%',
          paddingRight: '0.75rem',
          paddingLeft: '0.75rem',
        }
      })
    }
  ],
  
}