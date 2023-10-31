import React from 'react'
import { useAppContext } from './PokemonContextProvider'

type Props = {}

const PokemonFavorito = (props: Props) => {
  const { favorito, setfavorito } = useAppContext();
  return (
    <div>
      <h3>Pokémon favorito</h3>
      <div className="PokemonCard">

        <div className={favorito.type1}>
          <h3>{favorito.name}</h3>
          <h5>Tipo: {favorito.type1}</h5>
          <img src={favorito.front} alt={favorito.name} /><img src={favorito.front_shiny} alt={favorito.name} /><br />
          <img src={favorito.back} alt={favorito.name} /><img src={favorito.back_shiny} alt={favorito.name} />
          <h5>{favorito.weight} kg</h5>
          <h5>{favorito.height} m</h5>

        </div>
      </div>
    </div>
  )
}

export default PokemonFavorito