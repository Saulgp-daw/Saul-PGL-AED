import React from 'react'
import { useNavigate } from 'react-router-dom';
import axios from 'axios';
import useObtenerPartidas from './useObtenerPartidas';
import { useState } from 'react';
import { Partida } from '../models/Partida';
import useTablero from './useTablero';
import { usePartidaContext } from '../contexts/PartidaContextProvider';

type Props = {}

const usePartida = () => {
    const { arrayPartidas, setArrayPartidas, ruta } = useObtenerPartidas();
    const {partida, setpartida} = usePartidaContext();
    const [iniciar, setIniciar] = useState(false);
    

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

    function cargarPartida(partida: Partida){
        setpartida(partida);
        console.log(partida);
        
    }
    return { crearPartida, guardarPartidaJSON, cargarPartida, partida, iniciar, setIniciar }
}

export default usePartida