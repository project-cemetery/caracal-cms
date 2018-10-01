module.exports = {
  moduleFileExtensions: ["js", "json", "vue"],
  transform: {
    "^.+\\.js$": "babel-jest",
    ".*\\.(vue)$": "vue-jest"
  },
  moduleDirectories: ["node_modules", "assets"],
  moduleNameMapper: {
    "@site/(.*)": "<rootDir>/assets/$1"
  }
};
