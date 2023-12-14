import { BaseEntity, Column, Entity, OneToMany, PrimaryGeneratedColumn } from "typeorm";
import { Noticia } from "./Noticia";

@Entity("feed")
export class Feed extends BaseEntity {
    @PrimaryGeneratedColumn()
    id: number;

    @OneToMany(() => Noticia, noticia => noticia.feed)
    noticias: Noticia[];

    @Column('text')
    title: string;

    @Column('text')
    url: string;
}

