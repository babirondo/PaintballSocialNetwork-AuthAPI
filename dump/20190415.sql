--
-- PostgreSQL database dump
--

-- Dumped from database version 10.6 (Ubuntu 10.6-0ubuntu0.18.04.1)
-- Dumped by pg_dump version 10.6 (Ubuntu 10.6-0ubuntu0.18.04.1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'SQL_ASCII';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


--
-- Name: jogador_times_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.jogador_times_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.jogador_times_id_seq OWNER TO postgres;

--
-- Name: jogadores_id_jogador_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.jogadores_id_jogador_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.jogadores_id_jogador_seq OWNER TO postgres;

--
-- Name: usuarios_id_usuario_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.usuarios_id_usuario_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.usuarios_id_usuario_seq OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: usuarios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuarios (
    id_usuario integer DEFAULT nextval('public.usuarios_id_usuario_seq'::regclass) NOT NULL,
    senha character varying,
    id_jogador integer,
    email character varying,
    usuarioteste character varying
);


ALTER TABLE public.usuarios OWNER TO postgres;

--
-- Data for Name: usuarios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.usuarios (id_usuario, senha, id_jogador, email, usuarioteste) FROM stdin;
3	bruno	10	bruno	\N
4	stefany	11	stefany	\N
5	albano	12	albano	\N
6	osvaldo	13	osvaldo	\N
8	123456	15	dirceu.jr@gmail.com	\N
18	xalo	25	xalo	\N
19	maron	26	maron	\N
20	Nindah16$666	27	mariosouzaluan@gmail.com	\N
22	131782	29	martokh@gmail.com	\N
23	Bagley2319	30	bagley2010@gmail.com	\N
24	Ives031180	31	coupiedoupie@gmail.com	\N
25	Phoenix2018	32	mikepluff@gmail.com	\N
26	Palace1999	33	Lauchlancousens@hotmail.co.uk 	\N
27	Bigdog1o94	34	Dodds	\N
28	pbsocial	35	ricardo.guevara@gisportz.com	\N
29	Paintballislife09	36	 Silent.bob61@yahoo.com 	\N
30	1234	37	naotenhoemail@email.com	\N
31	Spyder147	38	chemdogxxx@gmail.com	\N
32	Aquarium13*	39	Apolishsniper@gmail.com 	\N
33		40		\N
34	ebdog100	41	brian.clettenberg@gmail.com	\N
35	Paintball	42	Venckus_arunas@yahoo.com	\N
36	t	45	t	null
37	q	46	q	null
38	p	47	p	null
39	w	48	w	null
40	m	49	m	null
41	1	50	q1	null
42	j	51	j	null
43	l	52	l	null
44	1	53	q1d	null
45	1	54	q1dd	null
46	1	55	q1ddd	null
47	w1	56	w1	null
48	n	57	n	null
49	6586	58	6586@test.com	null
50	6734	59	6734@test.com	null
51	2765	60	2765@test.com	null
52	6964	61	6964@test.com	null
53	1660	62	1660@test.com	null
54	4184	63	4184@test.com	null
55	7649	64	7649@test.com	null
56	6654	65	6654@test.com	null
57	3032	66	3032@test.com	null
58	7016	67	7016@test.com	null
59	4559	68	4559@test.com	null
60	5169	69	5169@test.com	null
61	6472	70	6472@test.com	null
62	6046	71	6046@test.com	null
63	7600	72	7600@test.com	null
64	2473	73	2473@test.com	null
65	6736	74	6736@test.com	null
66	6419	75	6419@test.com	null
67	6675	76	6675@test.com	null
68	4867	77	4867@test.com	null
69	1301	78	1301@test.com	null
70	4542	79	4542@test.com	null
71	5078	80	5078@test.com	null
72	1355	81	1355@test.com	null
73	2283	82	2283@test.com	null
74	4759	83	4759@test.com	null
75	3542	84	3542@test.com	null
76	4446	85	4446@test.com	null
77	4505	86	4505@test.com	null
78	4186	87	4186@test.com	null
79	1098	88	1098@test.com	null
80	1590	89	1590@test.com	null
81	3104	90	3104@test.com	null
82	4529	91	4529@test.com	null
83	8091	92	8091@test.com	null
84	4579	93	4579@test.com	null
85	2988	94	2988@test.com	null
86	3363	95	3363@test.com	null
87	3776	96	3776@test.com	null
88	7372	97	7372@test.com	null
89	4859	98	4859@test.com	null
90	2935	99	2935@test.com	null
91	5317	100	5317@test.com	null
92	3743	101	3743@test.com	null
93	3838	102	3838@test.com	null
94	3276	103	3276@test.com	null
95	7053	104	7053@test.com	null
96	7253	105	7253@test.com	null
97	7238	106	7238@test.com	null
98	1653	107	1653@test.com	null
99	1013	108	1013@test.com	null
100	8019	109	8019@test.com	null
101	7896	110	7896@test.com	1
102	5781	111	5781@test.com	1
103	4881	112	4881@test.com	1
104	7642	113	7642@test.com	null
105	antonio	114	antonio.cruz@gmail.com	null
106	miguel	115	miguel	null
107	alice	116	alice	null
108	dirceu	117	dirceu	null
109	r	118	r	null
110	Utru9ay1991	119	jacob.kvernberg@gmail.com	null
111	bloodhounds15	120	richard.ranalli@yahoo.com	null
112	RNB2019!	121	bymba27@gmail.com	null
113	telmadj	122	djunior@mundivox.com	null
114	Anton2011	123	roland.mayrhofer@gmx.at	null
115	novo	124	novo	null
116	15bpsmax	125	Paintzapper@gmail.com 	null
117	Q!w2e3r4	126	roga.araujo@gmail.com	null
118	rimom	127	rimom	null
119	Milly2001	128	teksfk@gmail.com	null
\.


--
-- Name: jogador_times_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.jogador_times_id_seq', 25, true);


--
-- Name: jogadores_id_jogador_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.jogadores_id_jogador_seq', 42, true);


--
-- Name: usuarios_id_usuario_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.usuarios_id_usuario_seq', 119, true);


--
-- Name: usuarios usuarios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (id_usuario);


--
-- PostgreSQL database dump complete
--

