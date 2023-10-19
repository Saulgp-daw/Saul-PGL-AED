import { useState } from "react";

export const PadreModificadoPorHijo = () => {
    const [state, setstate] = useState<number>(0);
    function modificarState(dato: number) { setstate(dato); }
    return (
        <div>
            <HijoModificaPadre modificarstatepadre={modificarState} />
            <h4>dato recibido de hijo: {state}</h4>
        </div>
    )
}
interface Iprops {
    modificarstatepadre: Function;
}
export const HijoModificaPadre = (props: Iprops) => {
    function enviarinfo() {
        const { modificarstatepadre } = props;
        let num = Math.random();
        modificarstatepadre(num);
    }
    return (
        <div>
            <button onClick={enviarinfo}>modificar padre</button>
        </div>
    )
}