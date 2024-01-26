package es.iespuertodelacruz.jc.graphqlfirstapp.controller;

import java.util.Arrays;
import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.graphql.data.method.annotation.Argument;
import org.springframework.graphql.data.method.annotation.MutationMapping;
import org.springframework.graphql.data.method.annotation.QueryMapping;
import org.springframework.graphql.data.method.annotation.SchemaMapping;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.security.access.prepost.PreAuthorize;
import org.springframework.stereotype.Controller;

import es.iespuertodelacruz.jc.graphqlfirstapp.security.LoginService;
import es.iespuertodelacruz.jc.graphqlfirstapp.security.UserDetailsLogin;




class Person{

	private int id;
	String name;
	int age;
	public String getName() {
		return name;
	}
	public void setName(String name) {
		this.name = name;
	}
	public int getAge() {
		return age;
	}
	public void setAge(Integer age) {
		this.age = age;
	}
	public Person() {}
	int getId() {
		return id;
	}
	void setId(int id) {
		this.id = id;
	}
}

@Controller
//@RequestMapping("/graphql")
public class PersonaGraphQL {
	
	@Autowired LoginService loginService;
	
	/*
	 * consulta:
	 * POST http://localhost:8080/graphql
	 * body: 
{
"query": " {  getAllPersons {    name  } }"
}
	 */
	
	//@PreAuthorize("hasAuthority('ROLE_ADMIN')")
	@QueryMapping
	public List<Person> getAllPersons() {
		Person p = new Person();
		p.setId(2);
		p.setName("nino");
		Person q = new Person();
		q.setId(5);
		q.setName("raco");
		
    
		return Arrays.asList(p,q);
		
		 
	}
	
	
	//@QueryMapping
	@SchemaMapping(typeName="Query", field="getPerson")
	public Person verPersona(@Argument String nombre) {
		Person p = new Person();
		p.setId(2);
		p.setName("nino");
		Person q = new Person();
		q.setId(5);
		q.setName("raco");
		
		if( nombre.equals("nino"))
			return p;
		else
			return q;
    

		
		 
	}	
	
	
	
	
	
	//@MutationMapping()
	@SchemaMapping(typeName = "Mutation", field = "agregar")
	public Person agregarPersona(
		@Argument int id, @Argument String name, @Argument int age
	) {
		Person person = new Person();
		person.setName(name);
		person.setId(id);
		person.setAge(age);
		return person;
	}
	
	@PreAuthorize("isAuthenticated()")
	@QueryMapping
	public Person getNico() {
		Person p = new Person();
		p.setId(2);
		p.setName("nino");
		
		
    
		return p;
		
		 
	}	

	
	
	
	@QueryMapping
	public String getLogin(@Argument String nombre, @Argument String password) {
		
		UserDetailsLogin udl = new UserDetailsLogin();
		udl.setUsername(nombre);
		udl.setPassword(password);
		
		String token = loginService.authenticate(udl);
		if (token == null)
			return "no es válido";
		else
			return token;
    
		
		
		 
	}
}
