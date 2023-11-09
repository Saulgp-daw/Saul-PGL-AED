import React from 'react'
import axios from 'axios';
export default function ModifyPoblacion() {

    function modificarPoblacion(event: React.FormEvent<HTMLFormElement>) {
        event.preventDefault();
        let formulario: HTMLFormElement = event.currentTarget;
        let inputnombre: HTMLInputElement = formulario.nombre;
        let inputanho: HTMLInputElement = formulario.anho;
        let inputpoblacion: HTMLInputElement = formulario.poblacion;
        let inputImg: HTMLInputElement = formulario.img;
        let inputId: HTMLInputElement = formulario.idPoblacion;
        let id: string = inputId.value;

        let nombre: string = inputnombre.value;
        let anho: number = parseInt(inputanho.value);
        let poblacion: number = parseInt(inputpoblacion.value);
        let img: string = inputImg.value;

        const updatedComunidad = {
            "id": nombre,
            "nombre": nombre,
            "datos": [{
                "anio": anho,
                "poblacion": poblacion
            }],
            "foto": img

        }
        let ruta = `http://localhost:3000/capitales/${id}`;
        const axiosPut = async (ruta: string) => {
            try {
                const response = await axios.put(ruta, updatedComunidad)
                console.log(response.data);
            } catch (error) {
                console.log(error);
            }
        }
        axiosPut(ruta);
    }
    return (
        <>
            <form onSubmit={modificarPoblacion}>
                Id: <input type="text" name="idPoblacion" /><br />
                Nombre: <input type="text" name="nombre" /><br />
                Año: <input type="text" name="anho" /><br />
                poblacion: <input type="text" name='poblacion' /><br />
                Img: <input type="text" name='img' /><br />
                <button type="submit">Crear </button>
            </form>
        </>
    )
}