# 🏥 Sistema de Cadastro e Triagem de Pacientes

Um sistema web simples e eficiente desenvolvido em **PHP** e **MySQL** para realizar o cadastro de pacientes em uma unidade de saúde, calculando automaticamente a sua prioridade e tempo de espera estimado com base no motivo da consulta.

---

## 🚀 Funcionalidades

- **Cadastro de Pacientes:** Formulário simples para captura de nome, ano de nascimento e motivo do atendimento.
- **Cálculo Automático de Idade:** O sistema calcula a idade do paciente no momento do cadastro.
- **Triagem Dinâmica:** Define o nível de prioridade (*Emergência*, *Pouco Urgente* ou *Não Urgente*) e associa o tempo médio de espera estimado.
- **Fila de Atendimento Ordenada:** Exibe os pacientes cadastrados priorizando quem possui o menor tempo de espera (casos mais graves primeiro).
- **Interface Responsiva e Amigável:** Estilização moderna em CSS para melhor usabilidade em dispositivos móveis e desktops.

---

## 🛠️ Tecnologias Utilizadas

- **HTML5 & CSS3** - Estrutura e estilização da interface.
- **PHP** - Lógica de backend e regras de negócio da triagem.
- **MySQL** - Banco de dados relacional para armazenamento dos registros.
- **Servidor Local** - Ambiente para execução do PHP e MySQL.

---

## 📁 Estrutura de Arquivos

```text
sistema_hospital/
├── index.php         # Página de cadastro do paciente
├── fila.php          # Página de visualização da fila de espera
└── style.css         # Ficheiro de estilos CSS para todo o sistema
```

## 🗄️ Configuração do Banco de Dados

Siga os passos abaixo para criar o banco de dados e a tabela necessária no seu servidor MySQL (ex: via **phpMyAdmin**):

1. Abra a sua ferramenta de gerenciamento do MySQL (ex: http://localhost/phpmyadmin).
2. Vá até a aba **SQL** e execute o comando abaixo para criar o banco de dados e a tabela de pacientes:

```sql
-- 1. Criação do Banco de Dados
CREATE DATABASE IF NOT EXISTS sistema_hospital;

-- 2. Seleção do Banco de Dados
USE sistema_hospital;

-- 3. Criação da Tabela de Pacientes
CREATE TABLE IF NOT EXISTS pacientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    ano_nascimento INT NOT NULL,
    idade INT NOT NULL,
    motivo VARCHAR(100) NOT NULL,
    prioridade VARCHAR(50) NOT NULL,
    tempo_espera INT NOT NULL
);