import axios from "axios";
import { useEffect, useState } from "react";

interface PokemonCardData {
    name: string; // El nombre del Pokémon
    image: string; // La URL de la imagen del Pokémon
    weight: number;
    height: number;
  }

type IProps = {
    urlApi: string
}

export default function PokemonCard(props: IProps){
    const [cardData, setCardData] = useState<PokemonCardData>({} as PokemonCardData);
    const uri: string = props.urlApi;

    useEffect( () => {
        async function getPokemonCard(direccion:string){
            const response = await axios.get(direccion);
            const newCard: PokemonCardData = {
                name: response.data.name,
                image: response.data.sprites.front_default,
                weight: response.data.weight,
                height: response.data.height

            }
            setCardData(newCard);
        }
        getPokemonCard(uri);
    }, []);

    return (
        <div className="PokemonCard">
            <h3>{cardData.name}</h3>
            <img src={cardData.image} alt={cardData.name} /><br />
            <h5>{cardData.weight} kg</h5>
            <h5>{cardData.height} m</h5>

        </div>
    )
}