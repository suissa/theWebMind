<?php
	/**
	 * This class takes care of the version control methods
	 *
	 * @author felipe
	 */
	class VersionManager {
		public static function commit()
		{
			/*
			 * OK atualizar a versaopegando(pegando a chave da nova versão)
			 * selecionar todas as tabelas e propriedades q nao estejam marcadas como drop
			 * ver diferenças entre cada tabela
			 * ver tabelas q ficaram sobrando na lista recem analisada(novas)
			 * ver tabelas q ficaram sobrando na lista antiga(para dropar)
			 * insere novas
			 * marca antigas como dropped
			 */
			$project= new DAO\ProjectFactory(Mind::$currentProject);
			$project->commit();
			Mind::$currentProject['pk_version']= $project->versionId;
			Mind::$currentProject['version']= $project->data['version'];
		}
		
		public static function setUp()
		{
		}
		
		public static function cleanUp()
		{
			$path= Mind::$currentProject['path']."/temp/";
			$entities= $path."entities~";
			$relations= $path."relations~";

			$fEnt= fopen($entities, "w+");
			$fRel= fopen($relations, "w+");
			if(!$fEnt)
			{
				Mind::write('permissionDenied');
				return;
			}
			ftruncate($fEnt, 0);
			ftruncate($fRel, 0);
			@chmod($entities, 0777);
			@chmod($relations, 0777);


			foreach(Analyst::$entities as &$entity)
			{
				file_put_contents($entities, serialize($entity)."\n", FILE_APPEND);
			}

			foreach(Analyst::$relations as &$relation)
			{
				file_put_contents($relations, serialize($relation)."\n", FILE_APPEND);
			}
			fclose($fEnt);
			fclose($fRel);
		}
	}