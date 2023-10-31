import axios from "axios";
import { useEffect, useState } from "react";
import '../CSS/practica40.css'
import { useAppContext } from "../Practica47/PokemonContextProvider";

export interface PokemonCardData {
    name: string; // El nombre del Pokémon
    front: string; // La URL de la imagen del Pokémon
    front_shiny: string;
    back: string;
    back_shiny: string;
    weight: number;
    height: number;
    type1: string;
}

type IProps = {
    urlApi: string
}

export default function PokemonCard(props: IProps) {
    const [cardData, setCardData] = useState<PokemonCardData>({} as PokemonCardData);
    const uri: string = props.urlApi;
    const {favorito, setfavorito } = useAppContext();

    useEffect(() => {
        async function getPokemonCard(direccion: string) {
            const response = await axios.get(direccion);
            console.log(response.data.types[0].type.name);

            const newCard: PokemonCardData = {
                name: response.data.name,
                front: response.data.sprites.front_default,
                front_shiny: response.data.sprites.front_shiny,
                back: response.data.sprites.back_default,
                back_shiny: response.data.sprites.back_shiny,
                weight: response.data.weight,
                height: response.data.height,
                type1: response.data.types[0].type.name

            }
            setCardData(newCard);
        }
        getPokemonCard(uri);
    }, []);

    function establecerFavorito (cardData: PokemonCardData){
        setfavorito(cardData);
    }

    return (
        <div className="PokemonCard">

            <div className={ cardData.type1}>
                <h3>{cardData.name}</h3>
                <h5>Tipo: {cardData.type1}</h5>
                <img src={cardData.front} alt={cardData.name} /><img src={cardData.front_shiny} alt={cardData.name} /><br />
                <img src={cardData.back} alt={cardData.name} /><img src={cardData.back_shiny} alt={cardData.name} />
                <h5>{cardData.weight} kg</h5>
                <h5>{cardData.height} m</h5>
                <button onClick={() => establecerFavorito(cardData)}>Establecer favorito</button>
            </div>
        </div>
    )
}