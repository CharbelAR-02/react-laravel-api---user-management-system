import axios from "axios";
const axiosClient = axios.create({
    baseURL: `${import.meta.env.VITE_API_BASE_URL}/api`,
});

axiosClient.interceptors.request.use((config) => {
    const token = localStorage.getItem("ACCESS_TOKEN");
    config.headers.Authorization = `Bearer ${token}`;
    return config;
});

axios.interceptors.response.use(
    // the first function is onfulfill and the second is onRejcted
    (response) => {
        return response;
    },
    (error) => {
        const { response } = error;
        if (response.status === 401) {
            //unauthorized
            localStorage.removeItem("ACCESS_TOKEN");
        }
        throw error;
    }
);

export default axiosClient;
