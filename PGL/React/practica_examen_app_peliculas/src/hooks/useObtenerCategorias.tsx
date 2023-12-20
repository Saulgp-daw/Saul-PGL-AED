import axios from 'axios';
import React from 'react'
import { useState, useEffect } from 'react';

type Props = {}

export interface iCategoria {
    id: number,
    nombre: string
}

const useObtenerCategorias = () => {
    const [categorias, setCategorias] = useState<iCategoria[]>([]);
    const ruta: string = "http://localhost:8080/api/categorias";


    useEffect(() => {
        async function recogerDatosCategorias() {
            const response = await axios.get<iCategoria[]>(ruta);
            //console.log(response.data);
            setCategorias(response.data);
        }

        recogerDatosCategorias();
    }, []);

    return { categorias }
}

export default useObtenerCategorias