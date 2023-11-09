import React, { useState } from 'react'

type Props = {}

type FormData = {
    jubilado: boolean,
    casado: boolean,
    edad: number,
    nombre: string
}
const useAnexo = () => {
    const [formdata, setFormdata] = useState<FormData>({} as FormData);

    function fillFormData(value: boolean | number | string, field: keyof FormData) {
        setFormdata(
            {
                ...formdata,
                [field]: value
            }
        );
    }
  return {formdata, fillFormData}
}

export default useAnexo