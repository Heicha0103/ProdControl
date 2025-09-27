// tailwind.config.js
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          DEFAULT: "#2F4A40",  // Verde tierra (principal)
          hover: "#3F6F57",    // Hover
          light: "#E8EFE9",    // Fondo claro
        },
        secondary: {
          DEFAULT: "#7BBF6A",  // Verde secundario
          dark: "#5C9A4F",
          light: "#D9F2D3",
        },
        neutral: {
          50: "#F9FAFB",
          100: "#F3F4F6",
          200: "#E5E7EB",
          300: "#D1D5DB",
          400: "#9CA3AF",
          500: "#6B7280",
          600: "#4B5563",
          700: "#374151",
          800: "#1F2937",
          900: "#111827",
        },
        surface: "#FFFFFF",   // Fondos blancos
        border: "#E8EFE9",    // Bordes
        text: {
          primary: "#2F4A40", // Texto principal
          secondary: "#6B7280",
        },
        success: {
          DEFAULT: "#22C55E", // Verde éxito
          dark: "#16A34A",
          light: "#BBF7D0",
        },
        warning: {
          DEFAULT: "#FACC15", // Amarillo advertencia
          dark: "#CA8A04",
          light: "#FEF9C3",
        },
        error: {
          DEFAULT: "#EF4444", // Rojo error
          dark: "#B91C1C",
          light: "#FECACA",
        },
      },
    },
  },
  plugins: [],
}
