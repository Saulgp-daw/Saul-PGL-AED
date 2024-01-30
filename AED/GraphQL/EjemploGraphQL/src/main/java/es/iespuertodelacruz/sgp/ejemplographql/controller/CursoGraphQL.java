package es.iespuertodelacruz.sgp.ejemplographql.controller;

import java.util.Arrays;
import java.util.List;

import org.springframework.graphql.data.method.annotation.Argument;
import org.springframework.graphql.data.method.annotation.QueryMapping;
import org.springframework.graphql.data.method.annotation.SchemaMapping;
import org.springframework.stereotype.Controller;

class Curso {
	String id;
	String nombre;
	String categoria;
	
	public String getId() {
		return id;
	}

	public void setId(String id) {
		this.id = id;
	}

	public String getNombre() {
		return nombre;
	}

	public void setNombre(String nombre) {
		this.nombre = nombre;
	}

	public String getCategoria() {
		return categoria;
	}

	public void setCategoria(String categoria) {
		this.categoria = categoria;
	}

	public Curso(String id, String nombre, String categoria) {
		super();
		this.id = id;
		this.nombre = nombre;
		this.categoria = categoria;
	}

	public Curso() {
		super();
	}
	
}
@Controller
public class CursoGraphQL { 
	 @QueryMapping
	 public List<Curso> cursos(){
		 Curso c1 = new Curso();
		 c1.setId("1");
		 c1.setNombre("LND");
		 c1.setCategoria("DAM");
		 
		 Curso c2 = new Curso("2", "BAE", "DAM");
		 return Arrays.asList(c1, c2);
		 
	 }
	 
	 @QueryMapping
	 @SchemaMapping(typeName="Query", field="curso")
	 public Curso curso(@Argument String id){

		 
		 Curso c3 = new Curso("3", "AED", "DAM");
		 return c3;
		 
	 }
}
