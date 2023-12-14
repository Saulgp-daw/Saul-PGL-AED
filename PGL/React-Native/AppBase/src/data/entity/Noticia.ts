import { BaseEntity, Column, Entity, ManyToOne, PrimaryGeneratedColumn } from "typeorm";
import {Feed} from "./Feed";

@Entity("noticia")
export class Noticia extends BaseEntity{
    @PrimaryGeneratedColumn()
    id: number;

    @ManyToOne(() => Feed)
    feed: Feed;

    @Column()
    titulo: string;

    @Column('text')
    descripcion: string;

    @Column('text', { nullable: true })
    contenido: string;

    @Column()
    visto: boolean;
}