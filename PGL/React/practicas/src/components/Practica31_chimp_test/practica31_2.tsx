import React, { SetStateAction, useEffect, useRef, useState } from 'react'
import { Partida } from './Partida';

type Props = {}

const Practica31_2 = (props: Props) => {
    /** USANDO CLASE PARTIDA */

    const [partida, setPartida] = useState<Partida>(new Partida());
    const [numerosOrdenados, setNumerosOrdenados] = useState<Array<number>>([]);
    const [numerosAleatorios, setNumerosAleatorios] = useState<Array<JSX.Element>>();
    const numAleatoriosRef = useRef<Array<number>>([]);
    const [segundos, setSegundos] = useState(99);

    useEffect(() => {
        numAleatoriosRef.current = [];
        setNumerosOrdenados(partida?.getArrayOrdenados());
        setSegundos(partida.getSegundosVisible());
        numAleatoriosRef.current = numAleatoriosRef.current.length === 0 ? partida?.generarNumerosAleatorios(partida.getCantidadNumeros()) : numAleatoriosRef.current;
        const nuevosAleatorios = numAleatoriosRef.current.map(numero => (
            <div className='cell' key={numero}>
                <span className="revealed">{numero}</span>
            </div>
        ));
        setNumerosAleatorios(nuevosAleatorios);
    }, [partida]);

    useEffect(() => {
        if (segundos > 0) {
            const temporizador = setTimeout(() => {
                setSegundos(segundos - 1);
            }, 1000);

            // Limpia el temporizador cuando el componente se desmonta
            return () => clearTimeout(temporizador);
        } else {
            const nuevosAleatorios = numAleatoriosRef.current.map(numero => (
                <div className='cell' onClick={() => probar(numero)} key={numero}>
                    <span className="hidden">{numero}</span>
                </div>
            ));
            setNumerosAleatorios(nuevosAleatorios);
        }

    }, [segundos]);

    function probar(num: number) {
        console.log("Numero: " + num);
        console.log(numerosOrdenados);

        setNumerosOrdenados(prevOrdenados => {
            // Añade num a ordenados solo si num es igual al length de ordenados
            if (num - 1 == prevOrdenados.length) {
                return [...prevOrdenados, num];
            }

            return prevOrdenados; // Si la condición no se cumple, devuelve el estado sin cambios
        });
    }

    function cambiarClase() {
        const nuevosAleatorios = numAleatoriosRef.current.map(numero => (
            <div className='cell' onClick={() => probar(numero)} key={numero}>
                <span className={`${numerosOrdenados.includes(numero) ? 'revealed' : 'hidden'}`}>{numero}</span>
            </div>
        ));
        setNumerosAleatorios(nuevosAleatorios);
    }

    useEffect(() => {
        // Este efecto se ejecutará cada vez que ordenados se actualice
        if (segundos == 0) {
            cambiarClase();
        }
        if (numerosOrdenados.length == partida.getCantidadNumeros()) {
            alert("Has ganado el videogame, aumentando la dificultad...");
            setPartida(new Partida(partida.getSegundosVisible()-1, partida.getCantidadNumeros()+2));
        }
    }, [numerosOrdenados]);



    return (
        <div>
            <h4>Practica31_2</h4>
            <div className='textoSegundos'>
                {segundos === 0 ? (
                    <p>¡Tiempo agotado! Haz click en orden correcto</p>
                ) : (
                    <p>Quedan {segundos} segundos. Memoriza bien la posición de los números</p>
                )}
            </div>
            <div className='container'>
                {numerosAleatorios}

            </div>
            <div>Aleatorios: {numAleatoriosRef.current}</div>
            <div>Ordenados: {numerosOrdenados}</div>

        </div>

    )
}

export default Practica31_2