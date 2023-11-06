import React from 'react'

type Props = {
    capital: Object;
}

const CapitalCard = (props: Props) => {
    const capitalActual = props.capital;
  return (
    <div>
        {JSON.stringify(capitalActual)}
    </div>
  )
}

export default CapitalCard