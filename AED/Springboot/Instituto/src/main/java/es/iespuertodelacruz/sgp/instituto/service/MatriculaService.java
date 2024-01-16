package es.iespuertodelacruz.sgp.instituto.service;

import java.util.List;
import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import es.iespuertodelacruz.sgp.instituto.entities.Asignatura;
import es.iespuertodelacruz.sgp.instituto.entities.Matricula;
import es.iespuertodelacruz.sgp.instituto.repository.IAlumnoRepository;
import es.iespuertodelacruz.sgp.instituto.repository.IAsignaturaRepository;
import es.iespuertodelacruz.sgp.instituto.repository.IMatriculaRepository;

@Service
public class MatriculaService  implements IGenericService<Matricula, Integer>{
	@Autowired
	private IAlumnoRepository alumnoRepository;
	
	@Autowired
	private IMatriculaRepository matriculaRepository;
	
	@Autowired
	private IAsignaturaRepository asignaturaRepository;

	@Override
	public Iterable<Matricula> findAll() {
		// TODO Auto-generated method stub
		return matriculaRepository.findAll();
	}

	@Override
	public Optional<Matricula> findById(Integer id) {
		// TODO Auto-generated method stub
		return matriculaRepository.findById(id);
	}

	@Override
	public Matricula save(Matricula element) {
		// TODO Auto-generated method stub
		Matricula matriculaGuardada = null;
		
		try {
			matriculaGuardada = matriculaRepository.save(element);
			matriculaGuardada.setAsignaturas(element.getAsignaturas());
			for(Asignatura m : matriculaGuardada.getAsignaturas()) {
				Optional<Asignatura> findById = asignaturaRepository.findById(m.getId());
				findById.get().getMatriculas().add(matriculaGuardada);
			}
			
		}catch (Exception ex) {
			System.out.println(ex);
		}
		return matriculaGuardada;

	}
	@Override
	public void deleteById(Integer id) {
		// TODO Auto-generated method stub
		Optional<Matricula> opt = matriculaRepository.findById(id);
		if(!opt.isPresent()) {
			return;
		}
		
		Matricula matricula = opt.get();
		List<Asignatura> asignaturas = matricula.getAsignaturas();
		if(asignaturas != null) {
			for(Asignatura a : asignaturas) {
				a.getMatriculas().remove(matricula);
			}
			asignaturas.clear();
		}
		matriculaRepository.delete(matricula);
		
	}

}
