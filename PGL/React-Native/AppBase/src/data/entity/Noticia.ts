import { BaseEntity, Column, Entity, ManyToOne, PrimaryGeneratedColumn } from "typeorm";
import { Feed } from "./Feed";

@Entity("noticia")
export class Noticia extends BaseEntity {
    @PrimaryGeneratedColumn()
    id: number;

    @ManyToOne(() => Feed, feed => feed.noticias)
    feed: Feed;

    @Column('text')
    titulo: string;

    @Column('text')
    descripcion: string;

    @Column('boolean')
    visto: boolean;
}