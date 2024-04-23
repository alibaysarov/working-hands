import axios from "axios";

const BASE_URL = `${new URL(window.location.href).protocol}//${new URL(window.location.href).hostname}${new URL(window.location.href).port?':'+new URL(window.location.href).port:''}`
const instance = axios.create({
    baseURL:BASE_URL+'/api'
})
const objectToUrlParams =(data)=>{
    if (!data || typeof data !== 'object') {
        return '';
    }
    let props=[]
    for (const [key,value] of Object.entries(data)) {
        props.push(`${key}=${value}`)
    }
    if(!props.length) {
        return ''
    }
    return `?${props.join('&')}`
}
class Api {
    async getAll(data) {
        const res = await instance.get('/advertisment/all'+objectToUrlParams(data));
        return res.data
    }
    async getOne(data) {
        const fields = data.fields??false
        const res = await instance.get(`/advertisment/${data.id}?fields=${fields}`);
        return res
    }

    async create(data) {
        const res = await instance.post(`/advertisment/create`,data);
        return res
    }
}
export default new Api()
