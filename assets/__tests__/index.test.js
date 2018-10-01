import Vue from "vue";
import jsdom from "jsdom";
import App from "../App";

const renderer = require("vue-server-renderer").createRenderer();

describe("App", () => {
  it("sanity check", () => {
    expect(true).toBe(true);
  });
});
