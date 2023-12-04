import { DataSource } from "typeorm";
import { Persona } from "./entity/Persona";

export const dataSource = new DataSource({
    database: 'personasdb.db',
    entities: [Persona],
    location: 'default',
    logging: [],
    synchronize: true,
    type: 'react-native'
});

export const PersonaRepository = dataSource.getRepository(Persona);