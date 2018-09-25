import axios from "axios";

class AxiosApiClient {
  constructor(baseUrl) {
    this.baseUrl = baseUrl;
  }

  login(userCredentials) {
    return axios
      .post(`${this.baseUrl}/login`, userCredentials, {
        headers: { "Content-Type": "application/json" }
      })
      .then(response => response.data)
      .catch(e => {
        window ? alert(e.message) : console.error(e.message);
      });
  }
}

export default AxiosApiClient;
