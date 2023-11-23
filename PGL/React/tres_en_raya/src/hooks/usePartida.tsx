import React from 'react'
import { useNavigate } from 'react-router-dom';
import axios from 'axios';
import useObtenerPartidas from './useObtenerPartidas';
import { useState } from 'react';
import { Partida } from '../models/Partida';
import { usePartidaContext } from '../contexts/PartidaContextProvider';


const usePartida = () => {
    const { arrayPartidas, ruta } = useObtenerPartidas();
    const {partida, setpartida} = usePartidaContext();
    const [iniciar, setIniciar] = useState(false);
    const navigate = useNavigate();
    

    function obtenerId() {
        let ultimoId: number = 0;
        if (arrayPartidas.partidas.length > 0) {
            ultimoId = (arrayPartidas.partidas[arrayPartidas.partidas.length - 1].getId()) + 1;
        }
        return ultimoId;
    }

    function crearPartida(event: React.FormEvent<HTMLFormElement>) {
        event.preventDefault();
        let formulario: HTMLFormElement = event.currentTarget;
        let nombreJ1: string = formulario.nombreJ1.value ?? "J1";
        let nombreJ2: string = formulario.nombreJ2.value ?? "J2";

        let tablero: string[][] = [[]];
        let nuevaPartida: Partida = new Partida(obtenerId(), nombreJ1, nombreJ2, tablero, "inacabada");
        setpartida(nuevaPartida);
        setIniciar(true);
        console.log(partida);
        //guardarPartida();
        

       
    }

    function guardarPartidaJSON(estaPartida: Partida){
        const axiospost = async () => {
            try {
                const response = await axios.post(ruta, estaPartida);
                console.log(response.status);
            } catch (error) {
                console.log(error);
            }
        }
        axiospost();
    }

    function borrarPartidaJSON(partida: Partida) {
        const axiosDelete = async () => {
            try {
                const response = await axios.delete(ruta + partida.getId());
                console.log(response);
                navigate("/");
            } catch (error) {
                console.log(error);
            }
        }
        axiosDelete();
    }


    return { crearPartida, guardarPartidaJSON, borrarPartidaJSON, partida, iniciar, setIniciar }
}

export default usePartida