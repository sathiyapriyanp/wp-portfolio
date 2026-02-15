const plugin = require('tailwindcss/plugin')
module.exports = {
  corePlugins: {
    preflight: false,
    container: false
  },
  // content: ["./../**/*.php"],
  content: ["./../**/*.{html,php,}"],
  darkMode: 'dark-mode',
  theme: {
   
    fontFamily:{
      sans: ['Montserrat', 'sans-serif'],
      RobotoFlex: ['Roboto Flex', 'sans-serif'],
      Almarai:['Almarai', 'sans-serif'],
    },
    scale: {
        'y-150': '1.5', // adds a scale-y-150 class
        'y-125': '1.25',
        'y-110': '1.1',
      },
    container: {
      center: true,
      padding:{
        DEFAULT: "1rem",
        xs:"0.5rem",
      },
    },
    extend: {
      keyframes: {
        marquee: {
          '0%': { transform: 'translateX(0%)' },
          '100%': { transform: 'translateX(-50%)' },
        },
      },
      animation: {
        marquee: 'marquee 20s linear infinite',
      },
      fontFamily: {
        roboto: ['Roboto', 'sans-serif'],
      },
      fontWeight: {
        'thin-custom': '10', // 100, 200, 300 ... weight value
      },
      screens:{
        xs: "425px",
        sm: "576px",
        md: "768px",
        lg: '1024px',
        xl: "1200px",
        '2xl': '1440px',
        '3xl': '1680px',
      },
      width: {
        custom_md: '30px',
      },
      height: {
        custom_md: '30px',
      },
      borderRadius:{
        30:'30px',
        20:'20px',
        10:'10px'
      },
      padding:{
        xs:"10px",
        sm:"15px",
        md:"30px",
        lg:"50px",
        xl:"60px",
      },
      margin:{
        xs:"10px",
        sm:"15px",
        md:"30px",
        lg:"50px",
        xl:"60px",
      },
      gap:{
        xs:"10px",
        sm:"15px",
        md:"30px",
        lg:"50px",
        xl:"60px",
      },
      colors:{
        brand: '#882345',
        primary_color_1: '#882345',
        primary_color_2: '#003478',
        primary_color_3: '#6C6F70',
        secondary_color_1:"#766A65",
        secondary_color_2:"#85CDDB",
        secondary_color_3:"#A29791",
        secondary_color_4:"#D0D1B4",
        text_primary: '#010913',
        color_1: '#F6F7F9',
        color_2: '#BDCBDE',
        color_3: '#B4B7B8',
        color_4: '#E9EAEC',
        gold: '#cbb98d',
        silver: '#bbb4b6',
        bronze: '#80936c9d'
      }
     
    },
  },
  plugins: [
    require('tailwindcss-rtl'),
    
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
    function ({ addUtilities }) {
      addUtilities({
        '.running': { 'animation-play-state': 'running' },
        '.paused': { 'animation-play-state': 'paused' },
      })
    },
    function ({ addComponents }) {
      addComponents({
        '.container': {
          maxWidth: '100%',
          marginLeft: 'auto',
          marginRight: 'auto',
          paddingRight: '15px',
          paddingLeft: '15px',
          '@screen md': {
            marginLeft: '60px',
            marginRight: '60px',
          },
          '@screen lg': {
            marginLeft: '100px',
            marginRight: '100px',
          },
          '@screen 3xl': {
            maxWidth: '1480px',
            marginRight: 'auto',
            marginLeft: 'auto',
          },
 
        }
      })
      addComponents({
        '.container-fluid': {
          maxWidth: '100%',
          marginRight: 'auto',
          marginLeft: 'auto',
          paddingRight: '15px',
          paddingLeft: '15px',
          // overflow:"hidden",
          '@screen md': {
            marginLeft: '30px',
            marginRight: '30px',
          },
          '@screen lg': {
            marginLeft: '40px',
            marginRight: '40px',
          },
          '@screen 3xl': {
            maxWidth: '1600px',
            marginRight: 'auto',
            marginLeft: 'auto',
          },
        }
      });
      addComponents({
        ".container-healthcare": {
          maxWidth: "1130px",
          marginRight: "auto",
          marginLeft: "auto",
          paddingRight: "30px",
          paddingLeft: "30px",
        },
      });
      addComponents({
        '.container-full': {
          maxWidth: '100%',
          marginRight: 'auto',
          marginLeft: 'auto',
          paddingRight: '15px',
          paddingLeft: '15px',
          // overflow:"hidden",
          '@screen md': {
            marginLeft: '15px',
            marginRight: '15px',
            
          }
        }
      });
      addComponents({
        ".container-clp": {
          maxWidth: "1118px",
          marginRight: "auto",
          marginLeft: "auto",
          paddingRight: "36px",
          paddingLeft: "36px",
        },
      });
    }
  ],
  
}