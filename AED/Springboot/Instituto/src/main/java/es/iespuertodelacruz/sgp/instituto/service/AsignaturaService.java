package es.iespuertodelacruz.sgp.instituto.service;

import java.util.List;
import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import es.iespuertodelacruz.sgp.instituto.entities.Asignatura;
import es.iespuertodelacruz.sgp.instituto.entities.Matricula;
import es.iespuertodelacruz.sgp.instituto.repository.IAsignaturaRepository;
import jakarta.transaction.Transactional;

@Service
public class AsignaturaService implements IGenericService<Asignatura, Integer>{
	
	@Autowired
	private IAsignaturaRepository asignaturaRepository;

	@Override
	public Iterable<Asignatura> findAll() {
		// TODO Auto-generated method stub
		return asignaturaRepository.findAll();
	}

	@Override
	public Optional<Asignatura> findById(Integer id) {
		// TODO Auto-generated method stub
		return asignaturaRepository.findById(id);
	}

	@Override
	@Transactional
	public Asignatura save(Asignatura element) {
		// TODO Auto-generated method stub
		Asignatura asignaturaGuardada = null;
		try {
			asignaturaGuardada = asignaturaRepository.save(element);
			
		}catch (Exception ex) {
			System.out.println(ex);
		}
		return asignaturaGuardada;
	}

	@Override
	@Transactional
	public void deleteById(Integer id) {
		// TODO Auto-generated method stub
		Optional<Asignatura> opt = asignaturaRepository.findById(id);
		
		if(!opt.isPresent()) {
			return;
		}
		
		Asignatura asignatura = opt.get();
		List<Matricula> matriculas = asignatura.getMatriculas();
		
		if(matriculas != null) {
			for(Matricula m : matriculas) {
				m.getAsignaturas().remove(asignatura);
			}
			matriculas.clear();
		}
		
		asignaturaRepository.delete(asignatura);
	}
	
	@Transactional
	public Asignatura update(Integer id, Asignatura asignatura) {
		Optional<Asignatura> asignaturaAntigua = asignaturaRepository.findById(id);
		if(asignaturaAntigua.isPresent()) {
			asignaturaAntigua.get().setNombre(asignatura.getNombre());
			asignaturaAntigua.get().setCurso(asignatura.getCurso());
			return asignaturaAntigua.get();
		}
		return null;
	}

}
