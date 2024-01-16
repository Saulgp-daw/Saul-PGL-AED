package es.iespuertodelacruz.sgp.instituto.service;

import java.util.ArrayList;
import java.util.List;
import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import es.iespuertodelacruz.sgp.instituto.entities.Alumno;
import es.iespuertodelacruz.sgp.instituto.entities.Matricula;
import es.iespuertodelacruz.sgp.instituto.repository.IAlumnoRepository;
import es.iespuertodelacruz.sgp.instituto.repository.IMatriculaRepository;
import jakarta.transaction.Transactional;

@Service	
public class AlumnoService implements IGenericService<Alumno, String> {
	
	@Autowired
	private IAlumnoRepository alumnoRepository;
	
	@Autowired
	private IMatriculaRepository matriculaRepository;
	
	@Override
	public Iterable<Alumno> findAll() {
		// TODO Auto-generated method stub
		return alumnoRepository.findAll();
	}

	@Override
	public Optional<Alumno> findById(String id) {
		// TODO Auto-generated method stub
		return alumnoRepository.findById(id);
	}

	@Override
	@Transactional
	public Alumno save(Alumno element) {
		// TODO Auto-generated method stub
		Alumno alumnoGuardado = null;
		try {
			alumnoGuardado = alumnoRepository.save(element);
		} catch (Exception ex) {
			System.out.println(ex);
		}
		return alumnoGuardado;
	}

	@Override
	@Transactional
	public void deleteById(String id) {
		// TODO Auto-generated method stub
		Optional<Alumno> opt = alumnoRepository.findById(id);
		if(!opt.isPresent()) {
			return;
		}
		
		Alumno alumno = opt.get();
		List<Matricula> matriculas = alumno.getMatriculas();
		if(matriculas != null) {
			for(Matricula m : matriculas) {
				if(m.getAlumno().getDni() == alumno.getDni()) {
					matriculaRepository.delete(m);
				}
			}
			matriculas.clear();
		}
		alumnoRepository.delete(alumno);
		
	}
	
	@Transactional
	public Alumno update(Alumno alumno) {
		Optional<Alumno> alumnoAntiguo = alumnoRepository.findById(alumno.getDni());
		
		if(alumnoAntiguo.isPresent()) {
			/*if(alumnoAntiguo.get().getMatriculas() != null) {
				List<Matricula> matriculasAntiguas = alumnoAntiguo.get().getMatriculas();
				for(Matricula m : matriculasAntiguas) {
					if(m.getAlumno().getDni() == alumnoAntiguo.get().getDni()) {
						matriculaRepository.delete(m);
					}
				}
				
				alumnoAntiguo.get().getMatriculas().clear();
				
				List<Matricula> matriculasAuxiliares = new ArrayList<Matricula>();
				List<Matricula> matriculas = alumno.getMatriculas();
				
				for(Matricula m : matriculas) {
					matriculasAuxiliares.add(m);
				}
				
				for(Matricula m : matriculasAuxiliares) {
					if(!alumnoAntiguo.get().getMatriculas().contains(m)) {
						Optional<Matricula> findById = matriculaRepository.findById(m.getId());
						findById.get().setAlumno(alumno);
						alumnoAntiguo.get().getMatriculas().add(findById.get());
					}
				}
			}*/
			alumnoAntiguo.get().setNombre(alumno.getNombre());
			alumnoAntiguo.get().setApellidos(alumno.getApellidos());
			alumnoAntiguo.get().setFechanacimiento(alumno.getFechanacimiento());
			alumnoAntiguo.get().setImagen(alumno.getImagen());
		}
		return alumnoAntiguo.get();
		
	}

}
