import axios from "axios";

const BASE_URL = `${new URL(window.location.href).protocol}//${new URL(window.location.href).hostname}${new URL(window.location.href).port?':'+new URL(window.location.href).port:''}`
const instance = axios.create({
    baseURL:BASE_URL+'/api'
})
class Api {
    async getAll() {
        const res = await instance.get('/advertisment/all')
        return res.data
    }
}
export default new Api()
