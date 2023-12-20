import React from 'react'
import useObtenerCategorias from './useObtenerCategorias';
import { useNavigate } from 'react-router-dom';
import axios from 'axios';

type Props = {}

const useCrearCategoria = () => {
    const { categorias } = useObtenerCategorias();
    const navigate = useNavigate();
    const ruta = "http://localhost:8080/api/categorias";

    function devolverUltimoIdCategoria(){
        let ultimoId: number = 0;
        if(categorias.length > 0){
            ultimoId = (categorias[categorias.length-1].id)+1;
        }

        return ultimoId;
    }

    function nuevaCategoria(event: React.FormEvent<HTMLFormElement>){
        event.preventDefault();
        let formulario: HTMLFormElement = event.currentTarget;
        let nombre: string = formulario.nombre.value ?? "Default";

        console.log(nombre);

        const axiospost = async () => {
            try{
                const response = await axios.post(ruta, {"id" : 0, "nombre": nombre});
                console.log(response.status);
                
                navigate("/");
            }catch(error){
                console.log(error);
                
            }
        }

        axiospost();
        
    }
  return { nuevaCategoria }
}

export default useCrearCategoria