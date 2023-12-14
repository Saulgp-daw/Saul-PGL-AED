import { DataSource } from "typeorm";
import { Persona } from "./entity/Persona";
import { Feed } from "./entity/Feed";
import { Noticia } from "./entity/Noticia";

export const dataSource = new DataSource({
    database: 'noticias.db',
    entities: [Noticia, Feed],
    location: 'default',
    logging: [],
    synchronize: true,
    type: 'react-native'
});

export const PersonaRepository = dataSource.getRepository(Persona);
export const NoticiaRepository = dataSource.getRepository(Noticia);
export const FeedRepository = dataSource.getRepository(Feed);