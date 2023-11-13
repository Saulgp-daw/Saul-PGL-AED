import React from 'react'
import axios from 'axios';
export default function CreatePoblacion() {

    function agregarPoblacion(event: React.FormEvent<HTMLFormElement>) {
        event.preventDefault();
        let formulario: HTMLFormElement = event.currentTarget;
        let inputnombre: HTMLInputElement = formulario.nombre;
        let inputanho: HTMLInputElement = formulario.anho;
        let inputpoblacion: HTMLInputElement = formulario.poblacion;
        let inputImg: HTMLInputElement = formulario.img;

        let nombre: string = inputnombre.value;
        let anho: number = parseInt(inputanho.value);
        let poblacion: number = parseInt(inputpoblacion.value);
        let img: string = inputImg.value;

        const newComunidad = {
            "id": nombre,
            "nombre": nombre,
            "datos": [{
                "anio": anho,
                "poblacion": poblacion
            }],
            "foto": img
            
        }
        let ruta = "http://localhost:3000/capitales";
        const axiospost = async (rutaDeMoneda: string) => {
            try {
                const response = await axios.post(rutaDeMoneda, newComunidad);
                console.log(response.data);
            } catch (error) {
                console.log(error);
            }
        }
        axiospost(ruta);
    }
    return (
        <>
            <form onSubmit={agregarPoblacion}>
                Nombre: <input type="text" name="nombre" /><br />
                Año: <input type="text" name="anho" /><br />
                poblacion: <input type="text" name='poblacion' /><br />
                Img: <input type="text" name='img' /><br />
                <button type="submit">Crear </button>
            </form>
        </>
    )
}