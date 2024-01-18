package es.iespuertodelacruz.sgp.instituto.service;

import java.util.ArrayList;
import java.util.List;
import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import es.iespuertodelacruz.sgp.instituto.entities.Asignatura;
import es.iespuertodelacruz.sgp.instituto.entities.Matricula;
import es.iespuertodelacruz.sgp.instituto.repository.IAlumnoRepository;
import es.iespuertodelacruz.sgp.instituto.repository.IAsignaturaRepository;
import es.iespuertodelacruz.sgp.instituto.repository.IMatriculaRepository;
import jakarta.transaction.Transactional;

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
	
	@Transactional
	public Matricula update(Matricula matricula) {
		
		Optional<Matricula> matriculaExistente = matriculaRepository.findById(matricula.getId());
		
		if(matriculaExistente.isPresent()) {
			if(matriculaExistente.get().getAsignaturas() != null) {
                List<Asignatura> asignaturasAntiguas = matriculaExistente.get().getAsignaturas();
                for(Asignatura a: asignaturasAntiguas) { //recorremos todas las asignaturas que teníamos antes para borrar la relación de la tabla intermedia
                    a.getMatriculas().remove(matriculaExistente.get());
                }
                matriculaExistente.get().getAsignaturas().clear();//ahora borramos todas las asignaturas que tenga esta matricula
                
                List<Asignatura> asignaturasAuxiliares = new ArrayList<Asignatura>();
                List<Asignatura> asignaturasNuevas = matricula.getAsignaturas();
                
                for(Asignatura a: asignaturasNuevas) {
                    asignaturasAuxiliares.add(a); //añadimos a un array auxiliar todas las asignaturas
                }
                
                /*
                 * Recorremos auxiliares, comprobamos si la matricula en bbdd ya tiene esa asignatura, si no
                 * la buscamos para poder hacer la transacción, le añadimos a su array de matriculas la recibida
                 * finalmente a la matricula ya existente le añadimos a su array la asignatura encontrada
                 */
                for(Asignatura a : asignaturasAuxiliares) {
                    if(!matriculaExistente.get().getAsignaturas().contains(a)) {
                        Optional<Asignatura> findAsignatura = asignaturaRepository.findById(a.getId());
                        findAsignatura.get().getMatriculas().add(matricula);
                        matriculaExistente.get().getAsignaturas().add(findAsignatura.get());
                    }
                }
            }
			
			matriculaExistente.get().setYear(matricula.getYear());
			matriculaExistente.get().setAlumno(matricula.getAlumno());
			
		}
		return matriculaExistente.get();
	}
	
	

}
