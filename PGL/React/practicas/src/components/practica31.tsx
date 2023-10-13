import React, { SetStateAction, useEffect, useRef, useState } from 'react'

type Props = {}

const Practica31 = (props: Props) => {
    const [ordenados, setOrdenados] = useState<Array<number>>([]);
    let numAleatorios: Array<number> = [];
    const numAleatoriosRef = useRef<Array<number>>([]);
    numAleatoriosRef.current = numAleatoriosRef.current.length === 0 ? generarNumerosAleatorios() : numAleatoriosRef.current;

    const [aleatorios, setAleatorios] = useState<Array<JSX.Element>>();

    useEffect(() => {
        const nuevosAleatorios = numAleatoriosRef.current.map(numero => (
            <div className='cell' onClick={() => probar(numero)} key={numero}>
                <span className={`cell ${ordenados.includes(numero) ? 'revealed' : 'hidden'}`}>{numero}</span>
            </div>
        ));
        setAleatorios(nuevosAleatorios);
        console.log("log del useeffect: " + numAleatoriosRef.current);

    }, []);

    function generarNumerosAleatorios(): Array<number> {
        const numAleatorios: Array<number> = [];
        for (let i = 0; i < 8;) {
            const numeroAleatorio = Math.floor(Math.random() * 8) + 1;
            if (!numAleatorios.includes(numeroAleatorio)) {
                numAleatorios.push(numeroAleatorio);
                i++;
            }
        }
        return numAleatorios;
    }

    function shuffleArray(array: Array<number>) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
        return array;
    }


    function probar(num: number) {
        console.log("Numero: " + num);
        console.log(ordenados);

        setOrdenados(prevOrdenados => {
            // Añade num a ordenados solo si num es igual al length de ordenados
            if (num - 1 == prevOrdenados.length) {
                return [...prevOrdenados, num];
            }
            return prevOrdenados; // Si la condición no se cumple, devuelve el estado sin cambios
        });
    }

    function cambiarClase() {
        console.log("log de cambiarClase: " + numAleatoriosRef.current);

        const nuevosAleatorios = numAleatoriosRef.current.map(numero => (
            <div className='cell' onClick={() => probar(numero)} key={numero}>
                <span className={`cell ${ordenados.includes(numero) ? 'revealed' : 'hidden'}`}>{numero}</span>
            </div>
        ));
        setAleatorios(nuevosAleatorios);

    }

    useEffect(() => {
        // Este efecto se ejecutará cada vez que ordenados se actualice
        cambiarClase();
    }, [ordenados]);


    return (
        <div>
            <h4>Practica31</h4>
            <div className='container'>
                {aleatorios}

            </div>
            <div>Aleatorios: {numAleatoriosRef.current}</div>
            <div>Ordenados: {ordenados}</div>
        </div>

    )
}

export default Practica31