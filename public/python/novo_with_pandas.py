from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from time import sleep
import os
import getpass
from bs4 import BeautifulSoup
from datetime import datetime
from selenium.webdriver.common.by import By
import pandas as pd
import sqlite3
import pyodbc
from sqlalchemy import create_engine
from datetime import date

from dotenv import load_dotenv
from dotenv import find_dotenv
load_dotenv(find_dotenv())

df_base = None
today = date.today()
def login_atender(matricula, senha):
    browser = webdriver.Firefox(executable_path='geckodriver.exe')

    # abrir a página do Atender.caixa
    url = 'https://atender.caixa/siouv/jsp/login/login.jsp'

    browser.get(url)

    form_usuario = browser.find_element_by_name('j_username')
    form_usuario.send_keys(matricula)

    form_senha = browser.find_element_by_name('j_password')
    form_senha.send_keys(senha)

    botao_login = browser.find_element_by_xpath('//form/table/tbody/tr/td/table[1]/tbody/tr[1]/td/div/table/tbody/tr[4]/td/table/tbody/tr/td[2]/a')
    botao_login.click()

    return browser


# In[3]:


# main
matricula = input('Digite sua matrícula: ')
senha = getpass.getpass('Digite sua senha: ')

browser = login_atender(matricula, senha)


# In[4]:


sleep(3)
browser.find_element_by_link_text('Consulta Ocorrências para Tratamento').click()
sleep(3)


# In[5]:


html = browser.page_source


# In[6]:


df = pd.read_html(html)[0]
df = df[df[3] == "Enviada"]
lista_siouv = df[0].values.tolist()
lista_siouv


# In[7]:


for siouv in lista_siouv:
    urlsiouv = '//a[contains(@href,'+ "'"+ siouv + "'"+ ')'+']'
    browser.find_element_by_xpath(urlsiouv).click()
    sleep(3)
    html = browser.page_source
    df = pd.read_html(html)[0]
    df = df[df[1].notna()]
    df = df.iloc[6:]
    soup = BeautifulSoup(html, 'html.parser')
    resultado=soup.find_all(id='tblPesquisarProponente')
    if df[0].str.contains('Protocolo SAC').any():
        sac = 'SAC'
    else:
        sac =  'SIOUV'
    df = df[~df[0].str.startswith('Protocolo SAC')]
    df = df[~df[0].str.startswith('Nº Pré-Ocorrência')]
    
    if df[0].str.contains("Telefone|Correio Eletrônico").any():
        manifesto = df[1].values[10]
        comentario = df[1].values[11]
        contato = df[0].values[3]
    else:
        contato = "Não Tem"
        manifesto = df[1].values[9]
        comentario = df[1].values[10]
        
    #pega Data e Hora
    dataEhora = datetime.today().strftime('%d/%m/%Y - %H:%M' )
    
    #pega natureza
    natureza = soup.find_all('option', {'selected': True})[1].text
    
    #pega unidade
    unidade = soup.find('input', {'name': 'unidadeEnvolvida'}).get('value')
    una = unidade.split(' ')
    
    #pega assunto
    assunto = soup.find_all('option', {'selected': True})[2].text
    
    #pega assunto
    Item = soup.find_all('option', {'selected': True})[3].text
    
    #pega Motivo
    Motivo = soup.find_all('option', {'selected': True})[4].text

    #pega vencimento
    vencimento = df[0].values[0].split(' ')


    #pega data da abertura
    dataAbertura = df[0].values[1].split(' ')


    #pega CPF
    cpf  = df[0].values[2].split(' ')


    #pega Nome
    nome = df[0].values[2].split('-')
    try:
        contato=contato.strip()
        email=contato.split('Correio Eletrônico')[1].strip()
    except:
        email='Sem Email'

    tabela = pd.DataFrame({'numeroSiouv': siouv, 'tipo': sac, 'natureza': natureza, 'vencimento': vencimento[1], 'dataAbertura': dataAbertura[2], 'Nome': nome[2]
                          ,'CPF': cpf[2],'contato': contato,'email': email, 'assunto': assunto, 'item': Item, 'motivo': Motivo,
                           'manifesto': manifesto,'comentario': comentario, 'created_at':dataEhora, 'unidade': una[0]},index=[0])
    if(df_base is None):
        df_base = tabela
    else:
        df_base = pd.concat([df_base, tabela], axis=0, join='outer', ignore_index=True)
    browser.get('https://atender.caixa/siouv/jsp/login/ConsultarOcorrencia.do?method=listarOcorrenciasExternasInternas&amp;perfilUsuario=administrador&amp;escopo=I&amp;ordenacaoOuvidoria=1&amp;ordenacaoSac=1&amp;ordenacaoInterna=1&amp;tipoOrdenacaoOuvidoria=ASC&amp;tipoOrdenacaoSac=ASC&amp;tipoOrdenacaoInterna=ASC')
    browser.find_element_by_css_selector('table.TabelaPadrao:nth-child(20) > tbody:nth-child(1) > tr:nth-child(2) > td:nth-child(1) > a:nth-child(1)').click()
    sleep(3)
print("FIM")


# In[8]:


driver='SQL Server'
host = 'SP7877SR600\CAIXASQLSP100'
base = '7257_2'

uri = f"mssql+pyodbc://{host}/{base}?trusted_connection=yes&driver={driver}"
print(uri)

engine = create_engine(uri, echo=False)

nome_tabela = 'TBL_SIOUV'    
    
print('Importando registros para a tabela', nome_tabela, 'SQL Server')

df_base.to_sql(
    nome_tabela,
    engine,
    if_exists='replace',
    index=False,
    chunksize=5000,
    schema='dbo'
    )


print('Processo finalizado')


# Verifica se ocorreu ok a importação, retorna um df
pd.read_sql('select * from dbo.TBL_SIOUV', engine)


# In[9]:


try:
    url = 'http://painelouvidoria.mz.caixa'
    browser.get(url)
    form_usuario = browser.find_element_by_name('login')
    form_usuario.send_keys(matricula)

    form_senha = browser.find_element_by_name('senha')
    form_senha.send_keys(senha)

    browser.find_element_by_id('btnSalvar').click()
except:
    sleep(8)
    url = 'http://painelouvidoria.mz.caixa'
    browser.get(url)
    form_usuario = browser.find_element_by_name('login')
    form_usuario.send_keys(matricula)

    form_senha = browser.find_element_by_name('senha')
    form_senha.send_keys(senha)

    browser.find_element_by_id('btnSalvar').click()


# In[10]:


d1 = today.strftime("%Y-%m")
browser.get('http://painelouvidoria.mz.caixa/avcaixa/abre-tela-penalidades/unidade/7257/mes/'+ d1 + '-01')


# In[11]:


sleep(8)
html = browser.page_source


# In[12]:


df = pd.read_html(html)[0]
df


# In[13]:


df_lista = pd.read_html(html)[0]
df_lista = df_lista['Ocorrência']
lista_painel = df_lista.values.tolist()
lista_painel = [str(x) for x in lista_painel] 
lista_painel


# In[ ]:


tipo = "PAINEL"
for siouv in lista_painel:
    browser.get('https://atender.caixa/siouv/jsp/login/DetalharOcorrencia.do?method=iniciarDetalhamento&sequencialOcorrencia='+siouv)
    sleep(3)
    html = browser.page_source
    df = pd.read_html(html)[0]
    df = df[df[1].notna()]
    df = df.iloc[6:]
    soup = BeautifulSoup(html, 'html.parser')
    resultado=soup.find_all(id='tblPesquisarProponente')
    
    df = df[~df[0].str.startswith('Protocolo SAC')]
    df = df[~df[0].str.startswith('Nº Pré-Ocorrência')]
    
    tipo = "PAINEL"
    
    if df[0].str.contains("Telefone|Correio Eletrônico").any():
        manifesto = df[1].values[10]
        comentario = df[1].values[11]
        contato = df[0].values[3]
    else:
        contato = "Não Tem"
        manifesto = df[1].values[9]
        comentario = df[1].values[10]
    
    #pega natureza
    natureza = soup.find_all('option', {'selected': True})[1].text
    
    #pega unidade
    unidade = soup.find('input', {'name': 'unidadeEnvolvida'}).get('value')
    una = unidade.split(' ')
    
    #pega assunto
    assunto = soup.find_all('option', {'selected': True})[2].text
    
    #pega assunto
    Item = soup.find_all('option', {'selected': True})[3].text
    
    #pega Motivo
    Motivo = soup.find_all('option', {'selected': True})[4].text

    #pega vencimento
    vencimento = df[0].values[0].split(' ')


    #pega data da abertura
    dataAbertura = df[0].values[1].split(' ')


    #pega CPF
    cpf  = df[0].values[2].split(' ')


    #pega Nome
    nome = df[0].values[2].split('-')
    try:
        contato=contato.strip()
        email=contato.split('Correio Eletrônico')[1].strip()
    except:
        email='Sem Email'

    tabela = pd.DataFrame({'numeroSiouv': siouv, 'tipo': tipo, 'natureza': natureza, 'vencimento': vencimento[1], 'dataAbertura': dataAbertura[2], 'Nome': nome[2]
                          ,'CPF': cpf[2],'contato': contato,'email': email, 'assunto': assunto, 'item': Item, 'motivo': Motivo,
                           'manifesto': manifesto,'comentario': comentario, 'created_at': dataEhora, 'unidade': una[0]},index=[0])
    
    if(df_base is None):
        df_base = tabela
    else:
        df_base = pd.concat([df_base, tabela], axis=0, join='outer', ignore_index=True)
        sleep(3)
print("FIM")


# In[ ]:


driver='SQL Server'
host = 'SP7877SR600\CAIXASQLSP100'
base = '7257_2'

uri = f"mssql+pyodbc://{host}/{base}?trusted_connection=yes&driver={driver}"
print(uri)

engine = create_engine(uri, echo=False)

nome_tabela = 'TBL_SIOUV'    
    
print('Importando registros para a tabela', nome_tabela, 'SQL Server')

df_base.to_sql(
    nome_tabela,
    engine,
    if_exists='replace',
    index=False,
    chunksize=5000,
    schema='dbo'
    )


print('Processo finalizado')


# Verifica se ocorreu ok a importação, retorna um df
pd.read_sql('select * from dbo.TBL_SIOUV', engine)


# In[ ]:




