module.exports = {
  root: true,
  parserOptions: {
    parser: 'babel-eslint',
  },
  env: {
    browser: true,
  },
  plugins: [
    "vue",
  ],
  extends: [
    "airbnb-base",
    "plugin:vue/recommended"
  ],
  rules: {
    'vue/no-unused-components': 0,
    'no-console': 2
  },
};
