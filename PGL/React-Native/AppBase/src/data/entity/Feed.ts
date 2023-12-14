import { BaseEntity, Column, Entity, PrimaryGeneratedColumn } from "typeorm";

@Entity("feed")
export class Feed extends BaseEntity {
    @PrimaryGeneratedColumn()
    id: number;

    @Column()
    title: string;

    @Column()
    url: string;
}

