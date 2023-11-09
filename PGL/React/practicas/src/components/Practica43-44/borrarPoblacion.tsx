import React from 'react'
import axios from 'axios';
export default function BorrarPoblacion() {

    function borrarPoblacion(event: React.FormEvent<HTMLFormElement>) {
        event.preventDefault();
        let formulario: HTMLFormElement = event.currentTarget;
        let inputId: HTMLInputElement = formulario.idPoblacion;
        let id: string = inputId.value;
        
        let ruta = "http://localhost:3000/capitales";
        const axiosDelete = async (ruta: string) => {
            try {
                const response = await axios.delete(ruta+"/"+id)
            } catch (error) {
                console.log(error);
            }
        }
        axiosDelete(ruta);
    }
    return (
        <>
            <form onSubmit={borrarPoblacion}>
                Id: <input type="text" name="idPoblacion" /><br />
                <button type="submit">Borrar </button>
            </form>
        </>
    )
}