--
-- PostgreSQL database dump
--

-- Dumped from database version 11.5 (Ubuntu 11.5-3.pgdg18.04+1)
-- Dumped by pg_dump version 11.5 (Ubuntu 11.5-3.pgdg18.04+1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: btree_gin; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS btree_gin WITH SCHEMA public;


--
-- Name: EXTENSION btree_gin; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION btree_gin IS 'support for indexing common datatypes in GIN';


--
-- Name: btree_gist; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS btree_gist WITH SCHEMA public;


--
-- Name: EXTENSION btree_gist; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION btree_gist IS 'support for indexing common datatypes in GiST';


--
-- Name: citext; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS citext WITH SCHEMA public;


--
-- Name: EXTENSION citext; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION citext IS 'data type for case-insensitive character strings';


--
-- Name: cube; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS cube WITH SCHEMA public;


--
-- Name: EXTENSION cube; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION cube IS 'data type for multidimensional cubes';


--
-- Name: dblink; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS dblink WITH SCHEMA public;


--
-- Name: EXTENSION dblink; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION dblink IS 'connect to other PostgreSQL databases from within a database';


--
-- Name: dict_int; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS dict_int WITH SCHEMA public;


--
-- Name: EXTENSION dict_int; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION dict_int IS 'text search dictionary template for integers';


--
-- Name: dict_xsyn; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS dict_xsyn WITH SCHEMA public;


--
-- Name: EXTENSION dict_xsyn; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION dict_xsyn IS 'text search dictionary template for extended synonym processing';


--
-- Name: earthdistance; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS earthdistance WITH SCHEMA public;


--
-- Name: EXTENSION earthdistance; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION earthdistance IS 'calculate great-circle distances on the surface of the Earth';


--
-- Name: fuzzystrmatch; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS fuzzystrmatch WITH SCHEMA public;


--
-- Name: EXTENSION fuzzystrmatch; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION fuzzystrmatch IS 'determine similarities and distance between strings';


--
-- Name: hstore; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS hstore WITH SCHEMA public;


--
-- Name: EXTENSION hstore; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION hstore IS 'data type for storing sets of (key, value) pairs';


--
-- Name: intarray; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS intarray WITH SCHEMA public;


--
-- Name: EXTENSION intarray; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION intarray IS 'functions, operators, and index support for 1-D arrays of integers';


--
-- Name: ltree; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS ltree WITH SCHEMA public;


--
-- Name: EXTENSION ltree; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION ltree IS 'data type for hierarchical tree-like structures';


--
-- Name: pg_stat_statements; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS pg_stat_statements WITH SCHEMA public;


--
-- Name: EXTENSION pg_stat_statements; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION pg_stat_statements IS 'track execution statistics of all SQL statements executed';


--
-- Name: pg_trgm; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS pg_trgm WITH SCHEMA public;


--
-- Name: EXTENSION pg_trgm; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION pg_trgm IS 'text similarity measurement and index searching based on trigrams';


--
-- Name: pgcrypto; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS pgcrypto WITH SCHEMA public;


--
-- Name: EXTENSION pgcrypto; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION pgcrypto IS 'cryptographic functions';


--
-- Name: pgrowlocks; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS pgrowlocks WITH SCHEMA public;


--
-- Name: EXTENSION pgrowlocks; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION pgrowlocks IS 'show row-level locking information';


--
-- Name: pgstattuple; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS pgstattuple WITH SCHEMA public;


--
-- Name: EXTENSION pgstattuple; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION pgstattuple IS 'show tuple-level statistics';


--
-- Name: tablefunc; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS tablefunc WITH SCHEMA public;


--
-- Name: EXTENSION tablefunc; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION tablefunc IS 'functions that manipulate whole tables, including crosstab';


--
-- Name: unaccent; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS unaccent WITH SCHEMA public;


--
-- Name: EXTENSION unaccent; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION unaccent IS 'text search dictionary that removes accents';


--
-- Name: uuid-ossp; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS "uuid-ossp" WITH SCHEMA public;


--
-- Name: EXTENSION "uuid-ossp"; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION "uuid-ossp" IS 'generate universally unique identifiers (UUIDs)';


--
-- Name: xml2; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS xml2 WITH SCHEMA public;


--
-- Name: EXTENSION xml2; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION xml2 IS 'XPath querying and XSLT';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: categories; Type: TABLE; Schema: public; Owner: yhqbrujn
--

CREATE TABLE public.categories (
    code integer,
    name character varying(30)
);


ALTER TABLE public.categories OWNER TO yhqbrujn;

--
-- Name: cities; Type: TABLE; Schema: public; Owner: yhqbrujn
--

CREATE TABLE public.cities (
    code numeric NOT NULL,
    name character varying(30)
);


ALTER TABLE public.cities OWNER TO yhqbrujn;

--
-- Name: delivers_to; Type: TABLE; Schema: public; Owner: yhqbrujn
--

CREATE TABLE public.delivers_to (
    city numeric,
    restaurant numeric
);


ALTER TABLE public.delivers_to OWNER TO yhqbrujn;

--
-- Name: dishes; Type: TABLE; Schema: public; Owner: yhqbrujn
--

CREATE TABLE public.dishes (
    code integer NOT NULL,
    name character varying(30),
    description character varying(200),
    price numeric,
    restaurant integer,
    category integer,
    ingredients character varying(300),
    nutri_carbs numeric,
    nutri_fats numeric,
    nutri_kcal numeric,
    nutri_proteins numeric,
    flag_gluten_free boolean,
    flag_lactose_free boolean,
    flag_vegan boolean,
    flag_fresh boolean,
    flag_zero_waste boolean,
    image_url character varying(400),
    delivery_time integer
);


ALTER TABLE public.dishes OWNER TO yhqbrujn;

--
-- Name: dishes_code_seq; Type: SEQUENCE; Schema: public; Owner: yhqbrujn
--

CREATE SEQUENCE public.dishes_code_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.dishes_code_seq OWNER TO yhqbrujn;

--
-- Name: dishes_code_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: yhqbrujn
--

ALTER SEQUENCE public.dishes_code_seq OWNED BY public.dishes.code;


--
-- Name: order_items; Type: TABLE; Schema: public; Owner: yhqbrujn
--

CREATE TABLE public.order_items (
    code integer NOT NULL,
    ord integer,
    item integer,
    quantity integer,
    notes character varying(100)
);


ALTER TABLE public.order_items OWNER TO yhqbrujn;

--
-- Name: order_items_code_seq; Type: SEQUENCE; Schema: public; Owner: yhqbrujn
--

CREATE SEQUENCE public.order_items_code_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.order_items_code_seq OWNER TO yhqbrujn;

--
-- Name: order_items_code_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: yhqbrujn
--

ALTER SEQUENCE public.order_items_code_seq OWNED BY public.order_items.code;


--
-- Name: orders; Type: TABLE; Schema: public; Owner: yhqbrujn
--

CREATE TABLE public.orders (
    code integer NOT NULL,
    restaurant integer,
    full_name character varying(50),
    address character varying(50),
    city integer,
    phone character varying(70),
    shipping_type integer,
    shipping_cost numeric,
    total_cost numeric,
    delivery_deadline timestamp without time zone,
    status integer,
    email character varying(70)
);


ALTER TABLE public.orders OWNER TO yhqbrujn;

--
-- Name: orders_code_seq; Type: SEQUENCE; Schema: public; Owner: yhqbrujn
--

CREATE SEQUENCE public.orders_code_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.orders_code_seq OWNER TO yhqbrujn;

--
-- Name: orders_code_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: yhqbrujn
--

ALTER SEQUENCE public.orders_code_seq OWNED BY public.orders.code;


--
-- Name: restaurants; Type: TABLE; Schema: public; Owner: yhqbrujn
--

CREATE TABLE public.restaurants (
    code integer NOT NULL,
    name character varying(30),
    cost_eat_in double precision,
    cost_takeaway double precision,
    cost_home_delivery double precision,
    description character varying(1000),
    access_token character varying(32),
    image_url character varying(500),
    contact character varying(30)
);


ALTER TABLE public.restaurants OWNER TO yhqbrujn;

--
-- Name: dishes code; Type: DEFAULT; Schema: public; Owner: yhqbrujn
--

ALTER TABLE ONLY public.dishes ALTER COLUMN code SET DEFAULT nextval('public.dishes_code_seq'::regclass);


--
-- Name: order_items code; Type: DEFAULT; Schema: public; Owner: yhqbrujn
--

ALTER TABLE ONLY public.order_items ALTER COLUMN code SET DEFAULT nextval('public.order_items_code_seq'::regclass);


--
-- Name: orders code; Type: DEFAULT; Schema: public; Owner: yhqbrujn
--

ALTER TABLE ONLY public.orders ALTER COLUMN code SET DEFAULT nextval('public.orders_code_seq'::regclass);


--
-- Data for Name: categories; Type: TABLE DATA; Schema: public; Owner: yhqbrujn
--

COPY public.categories (code, name) FROM stdin;
1	Pizza
2	Asian
3	Buns
4	Others
\.


--
-- Data for Name: cities; Type: TABLE DATA; Schema: public; Owner: yhqbrujn
--

COPY public.cities (code, name) FROM stdin;
139	Bolzano
12	Merano
125	Brescia
100	Verona
20	Innsbruck
14	Trento
\.


--
-- Data for Name: delivers_to; Type: TABLE DATA; Schema: public; Owner: yhqbrujn
--

COPY public.delivers_to (city, restaurant) FROM stdin;
139	1
12	1
14	2
12	2
139	2
139	3
20	3
139	4
20	4
125	5
100	5
139	6
14	6
12	6
100	6
125	6
100	7
125	7
14	7
139	8
14	8
100	8
\.


--
-- Data for Name: dishes; Type: TABLE DATA; Schema: public; Owner: yhqbrujn
--

COPY public.dishes (code, name, description, price, restaurant, category, ingredients, nutri_carbs, nutri_fats, nutri_kcal, nutri_proteins, flag_gluten_free, flag_lactose_free, flag_vegan, flag_fresh, flag_zero_waste, image_url, delivery_time) FROM stdin;
127	Uramaki California	The most famous sushi course!	6	8	2	Raw salmon, rice, seaweeds, sesame seeds, salt, rice vinegar	20	23	450	27	t	t	f	t	t	https://images.fidhouse.com/fidelitynews/wp-content/uploads/sites/6/2020/01/1580315600_842a0278b5b34385f186c24c69e5c3cb369c2b20-1580290176.jpg	35
130	Temaki	The biggest of all sushi dishes!	12	8	2	Rice, nori seaweeds, salmon, sesame seeds, cucumbers, salt.	30	15	300	12	t	t	f	t	t	https://www.agrodolce.it/app/uploads/2017/05/Temaki.jpg	35
135	Vegan Chili	A delicious, warming vegan dish	12	6	4	red beans, carots, olive oil, onions, avocado, tomatoes, salt	34	11	440	24	t	t	t	t	t	https://cookieandkate.com/images/2015/11/best-vegetarian-chili-1-1.jpg	35
131	Chow Mein	One of the best Chinese dishes	6	7	2	noodles, onion, sliced meat, green pepper and green onion	29	21	450	12	f	t	f	t	t	https://primochef.it/wp-content/uploads/2019/07/SH_chow_mein_spaghetti_cinesi-1200x800.jpg	30
132	Kung Pao Chicken	Popular for a reason!	6	7	2	Fried chicken, peanuts, dried chili, grilled peppers	21	11	500	38	f	t	f	t	t	https://www.jessicagavin.com/wp-content/uploads/2019/01/kung-pao-chicken-5-1200.jpg	35
134	Pizza kebab	The two perfect dishes merged in one!	10	3	3	Wheat flour, cheddar cheese, water, kebab, onions, ketchup, salt	40	45	800	28	f	f	f	t	t	https://www.indiscreto.info/wp-content/uploads/2015/07/Pizza-Kebab-1280x800.jpg	30
13	Pizza marinara	Marinara at its best!	4	1	1	wheat flour, tomato, garlic, olive oil	33	5	200	6	f	t	t	t	t	https://dileidemosite.files.wordpress.com/2019/09/calorie-pizza-marinara.jpg	30
136	Spinach Quiche	A delicious and filling quiche!	13	6	4	Wheat flour, water, spinach, broccoli, seasoned onion, tomatoes, garlic, peppers, oil, salt	23	11	500	12	f	t	t	t	t	https://www.simplejoy.com/wp-content/uploads/2019/01/spinach_quiche_recipe_Image.jpg	35
133	Dumplings	 Chinese new year dish!	10	7	2	Wheat flour, water, minced pork, chicken, chopped vegetables(peppers, zucchini), salt	23	11	400	12	f	t	f	t	t	https://www.thespruceeats.com/thmb/uof94YPDmDqP0kAlbi_t04VR47E=/4000x3000/smart/filters:no_upscale()/chinese-pan-fried-dumplings-694499_hero-01-f8489a47cef14c06909edff8c6fa3fa9.jpg	35
12	Pizza capricciosa	The best capricciosa	6	1	1	wheat flour, mozzarella cheese, tomato, artichokes, ham, olive oil	33	20	320	20	f	f	f	t	t	https://primochef.it/wp-content/uploads/2018/05/SH_pizza_capricciosa.jpg	40
129	Hosomaki veggie	A green alternative to the classic hosomaki!	7	8	2	Rice, nori seaweeds, avocado, carots, cucumbers, salt.	20	13	340	9	t	t	t	t	t	https://greenmagazine.it/wp-content/uploads/2014/12/raw-sushi.jpg	25
1	Hamburger	The best hamburger in town	10	3	3	Water, flour, yeast, salt, pepper, hamburger, milk	50	10	500	20	f	f	f	t	t	https://wips.plug.it/cips/buonissimo.org/cms/2019/03/hamburger.jpg	30
6	Caesar salad	The fresh flavours of your vegetable garden	10	2	4	Salad, cucumber, tomato, chicken breast, oil, pepper, salt	10	10	300	20	f	t	f	t	t	https://www.thespruceeats.com/thmb/Q8tgENw4e3yDt9XfBh8tHP8zldg=/2500x1406/smart/filters:no_upscale()/caesar-salad-2500-56a210635f9b58b7d0c62d64.jpg	25
72	Nigiri Mix	Delight yourself with these delicious nigiri!	8	8	2	Rice, tuna, salmon, sea bass	53	0	260	40	t	t	f	t	t	https://www.confesercentiparma.it/wp-content/uploads/2017/03/118-578-Sushi-e-Sashimi-corso-base.jpg	40
7	Cheeseburger	The power of the cheese mixed to the flavour of the meat	8	3	3	Water, flour, yeast, salt, pepper, cheddar cheese, hamburger, milk	30	40	700	17	t	f	f	t	t	https://i.redd.it/lzh3ysy58np21.jpg	30
61	Greta Burger	A zero impact burger	11	6	3	Water, flour, yeast, salt, pepper, onion, salad, lentil hamburger, soy milk	49.8	20.4	535	15	f	t	t	t	t	https://www.ilfattoalimentare.it/wp-content/uploads/2016/10/veg-burger-vegetariano-vegano-Fotolia_103042191_Subscription_Monthly_M.jpg	30
32	Kebab piadina	Just a rolled Kebab	7	3	3	wheat flour, butter, bovine meat, onion, spicy sauce, yogurt sauce, tomato	50	25.4	650	23.6	f	f	f	t	t	https://4.bp.blogspot.com/-fO7Oi5ibd10/Vu5y7dA6q1I/AAAAAAAAACs/8N9ou2qMuCMflH13CO8ZkiWlAvk7IlMNA/s1600/IMG_3586.JPG	40
41	Kebab sandwich	Light Kebab, ligh price	3.4	4	3	wheat flour, bovine meat, onion, spicy sauce, yogurt sauce, tomato	40.5	33.9	650	23.6	f	f	f	t	t	https://i.redd.it/bsstp4oqcia31.jpg	30
53	Pizza marinara	The good, classic Marinara!	4	5	1	wheat flour, tomato, garlic, olive oil	33	5	200	6	f	t	t	t	t	https://images.lacucinaitaliana.it/wp-content/uploads/2019/05/07173704/Marasco-Marinara-ai-quattro-pomodori-c-1600x800.jpg	30
71	Veggy Yaki Hudon	Best japanese first plate	15	8	2	Noodles (wheat flour, salt, palm oil), carrots, soybeans, palm oil, soy sauce, salt, pepper, garlic, sake, mushrooms, sesame seeds	55.4	22.7	343	9	f	t	t	t	f	https://cdn.ilclubdellericette.it/wp-content/uploads/2019/05/noodles-con-pak-choi-e-funghi-shiitake.jpg	30
82	Bao Buns	Fluffy steamed buns	8	7	2	Wheat flour, garlic sauce, mushrooms, bamboo, parsley, pepper, peanuts	10	12	154	16	f	t	t	t	t	https://www.connoisseurusveg.com/wp-content/uploads/2018/07/vegan-bao-buns-2-of-2.jpg	30
11	Pizza margherita	Best margherita at best price	3.5	1	1	wheat flour, mozzarella, tomato, olive oil	33	10	266	11	f	f	f	t	t	https://wips.plug.it/cips/buonissimo.org/cms/2020/02/pizza-margherita.jpg	30
62	Miso Soup	A good warm miso soup	6	6	2	carrots,daikon radish,pumpkin,onion,potato,tofu	49.8	20.4	50	15	t	t	t	t	t	https://keyassets-p2.timeincuk.net/wp/prod/wp-content/uploads/sites/53/2018/11/Chicken-miso-soup-1.jpg	30
22	Margherita GF	A good classic alternative!	6	2	1	wheat flour gluten-free, mozzarella, tomato, olive oil	33	10	300	11	t	f	f	t	t	https://www.melarossa.it/wp-content/uploads/2018/11/pizza-margherita-senza-glutine.jpeg	30
21	Pizza margherita	A great classic!	5	2	1	wheat flour, mozzarella, tomato, olive oil	35	15	300	12	f	f	f	t	t	https://static.cookist.it/wp-content/uploads/sites/21/2018/04/pizza-margherita-fatta-in-casa.jpg	25
51	Pizza margherita	Margherita: From Napoli with love	4	5	1	wheat flour, mozzarella, tomato, olive oil	33	10	266	11	f	f	f	t	t	https://www.dissapore.com/wp-content/uploads/2018/03/pizza-cracco.jpg	25
42	Falafel sandwich	From traditions comes the best	7	4	3	wheat flour, chickpeas flour, onion, spicy sauce, tomato	50	25.4	650	23.6	f	t	t	t	t	https://img.delicious.com.au/9-H5hhua/del/2019/06/mighty-medina-falafel-sandwich-109292-2.jpg	25
20	Pizza Salamino	The hottest peperoni you will ever taste!	5	1	1	wheat flour, mozzarella, tomato, olive oil, pepperoni	35	30	650	20	f	f	f	t	t	https://www.selezionecasillo.com/media/k2/items/cache/f3051eb70b962b646ad926757115bce0_XL.jpg	40
28	Veggie pizza	A completely vegan pizza	10	1	1	wheat flour, tomato sauce, veg mozzarella, zucchini, grilled peppers, olive oil	40	10	450	10	f	t	t	t	t	https://www.paneangelicdn.it/media/uploads/recipe/5cd0207f77185_pizza-verdure-grigliate.jpg	40
52	Pizza margerita GF	Margherita: From Napoli with love but without gluten	5	5	1	gluten free flour, mozzarella cheese, tomato, olive oil	33	20	300	20	t	f	f	t	t	https://1.bp.blogspot.com/-CNzUMIzUQQM/V9p6d7-4PqI/AAAAAAABb2g/o2-Fir11lp0OBLdFd5YXMFetf9Jmc4o5QCLcB/s1600/Gluten%2BFree%2BMargherita%2BPizza%2B%25281%2529.jpg	40
31	Kebab sandwich	The best kebab sandwich in town!	6.5	3	3	wheat flour, bovine meat, onion, spicy sauce, yogurt sauce, tomato	50.5	33.9	600	33.6	f	f	f	t	t	https://www.thespruceeats.com/thmb/nSlASEexPI_AjsTDFtRIh7Ub1tI=/2734x3645/filters:fill(auto,1)/lambkebabtatziki-589e60473df78c4758369400.jpeg	30
81	Spring rolls	just rolled happiness!	4.5	7	2	Soybeans, carrots, zucchini, sunflower seeds oil, pal oil, wheat flour	4	8	154	16	f	t	t	t	t	https://tasteasianfood.com/wp-content/uploads/2017/08/Spring-rolls-feature-image.jpg	25
\.


--
-- Data for Name: order_items; Type: TABLE DATA; Schema: public; Owner: yhqbrujn
--

COPY public.order_items (code, ord, item, quantity, notes) FROM stdin;
76	44	82	1	Make it spicy please!
77	45	134	1	\N
78	45	32	3	\N
79	46	61	2	be quick!
80	47	62	1	Make sure it is vegan!
81	48	6	1	\N
82	49	61	1	Make sure it is vegan!
84	51	134	1	No cheese please!
74	42	7	1	\N
75	43	21	1	\N
83	50	134	1	\N
85	52	42	2	\N
86	52	41	1	\N
87	53	41	1	\N
88	54	28	2	Please be quick, and make them tasty!
89	54	12	1	Please be quick, and make them tasty!
90	54	11	2	Please be quick, and make them tasty!
91	55	20	1	Please be quick, and make them tasty!
92	56	42	1	
93	57	6	1	
94	58	7	1	cheesy!
95	59	61	1	veggy!
96	60	6	1	\N
97	61	61	6	veggy!
98	62	13	1	
99	63	81	1	
\.


--
-- Data for Name: orders; Type: TABLE DATA; Schema: public; Owner: yhqbrujn
--

COPY public.orders (code, restaurant, full_name, address, city, phone, shipping_type, shipping_cost, total_cost, delivery_deadline, status, email) FROM stdin;
42	3	Mario Rossi	Via Einaudi 10	139	111 22 23 334	1	\N	8	2020-06-02 22:57:20	1	mariorossi@mail.com
43	2	Mario Rossi	Via Einaudi 10	139	111 22 23 334	2	2	7	2020-06-02 22:52:21	2	mariorossi@mail.com
44	7	Luigi Verdi	Via Mazzini 3	100	444 55 55 321	2	2	10	2020-06-02 23:03:24	1	luigiverdi@mail.com
45	3	Andrea Grigi	Via Asiago 1	20	222 22 11 123	1	\N	31	2020-06-02 23:16:36	1	andreagrigi@mail.com
47	6	Michele Gialli	Via Brenta 24	12	455 30 23 123	0	2.5	8.5	2020-06-02 23:26:42	2	michelegialli@mail.com
46	6	Lorenzo Neri	Via Adamello 34	100	567 69 59 432	2	3.5	25.5	2020-06-02 23:24:20	2	lorenzoneri@mail.com
48	2	Stefano Arancioni	Via Pallone 10	139	333 444 239 1	2	2	12	2020-06-02 23:39:37	1	stefanoarancioni@mail.com
51	3	Giovanni	Violi	20	111 222 333 4	2	2	12	2020-06-04 00:17:46	2	giovannivioli@mail.com
52	4	Michele	Russo	20	345543322	2	1.5	18.9	2020-06-04 00:40:39	1	michelerusso@mail.com
53	4	Walter Müller	Via dei portici 1	20	123456789	0	0	3.4	2020-06-04 00:42:50	2	waltermuller@mail.com
54	1	Andres Steinmeir	piazza erbe	139	123456789	2	1.5	34.5	2020-06-04 00:56:21	2	andresstein@mail.com
55	1	Lukas Mliler	piazzetta Darwin	139	48943033	1	\N	5	2020-06-04 00:58:57	1	lukasmiller@mail.com
58	3	Giovanni	Marroni	139	345849393	2	2	10	2020-06-05 14:18:27	2	giovannimarroni@mail.com
59	6	Giovanni	Marroni	139	345849393	2	3.5	14.5	2020-06-05 14:18:28	1	giovannimarroni@mail.com
60	2	Giovanni	Marroni	139	345849393	1	\N	10	2020-06-05 14:20:22	0	giovannimarroni@mail.com
61	6	Giovanni	Marroni	139	345849393	2	3.5	69.5	2020-06-05 14:41:57	1	giovannimarroni@mail.com
\.


--
-- Data for Name: restaurants; Type: TABLE DATA; Schema: public; Owner: yhqbrujn
--

COPY public.restaurants (code, name, cost_eat_in, cost_takeaway, cost_home_delivery, description, access_token, image_url, contact) FROM stdin;
1	Pizzeria Vesuvio	0	0	1.5	Our Pizzeria will bring to your place the flavours and the delicacies of the real Neapolitan cuisine. Our pizza chefs come straight outta Naples, many of them have worked in some of the most awarded pizzerie in the world, Sorbillo and Salvatore just to name a few. Our dishes are made only of fresh daily sourced products. Quality stands for us over everything. Try our pizze, you will not regret it!	4rarlZAZN5%wIwJ!S9BZRi&bI*udISkV	https://media-cdn.tripadvisor.com/media/photo-s/0e/b1/0d/7a/gemelli-fusco-pizzaioli.jpg	pizzeriavesuvio@gmail.com
3	Kebabland	0	0	2	Kebab is not a food, kebab is a philosophy! Our Kebab restaurant brings the best ingredients from all over the world to your place. Our yogurt sauce as been awarded as the best of Italy, our meat is strictly selected to meet some very high quality standards. If you are vegetarian or vegan, try out our veg menus! For any doubts on allergenes dont hesitate to reach us out!	cdkHbHonjb%hBI*cPoNjfMf@Ck2DxNgK	https://video-images.vice.com/articles/59c4f39a41d43541143c0a79/lede/1506080303445-donne-kebab-munchies.png?crop=1xw:0.9997037914691943xh	345 89 12 111
2	Bellanapule	1.5	0	2	From the street of Naples to your home! Try our delicacies and you will travel in a world of scents and flavours of the old Naples. Our food philosophy tries to respect and continue the cooking traditions our forefathers handed down to us and at the same time it tries to innovate and keep looking for new ingredients and new techniques!	UCrbx3IuW@B2!4wuh6ax^KVlKA^3hThI	https://www.agrodolce.it/app/uploads/2018/01/pizzaiolo.jpg	bellanapule@gmail.com
7	ChinaTown	1.5	0	2	Straight out the far east, the dishes and the ingredients that have made chinese cuisine great! Our chinese chefs have decades of experience in the field and they have worked in some of the most famous and renowned chinese restaurants in the world. Our ingredients are carefully selected to meet the highest quality standards!	t7L$xYoRdQlMliXPUgWr6#%!YtME5LyK	https://www.ansa.it/webimages/cl_1100x/2020/2/23/c703f4200dfb19f50de276b0f47ede5d.jpg	chinatown@gmail.com
8	Osakasa	0	0	2	Osakasa is not just a restaurant, it is the story of a family which has dealt with food and cuisine for more than 4 generations! The traditional japanese flavours are the key elements of all our delicacies! Try us out, it will be an unforgettable food experience!	8YmM0Us1NCH&Jqa4y@IdvnioAFBiegvm	https://i.insider.com/52d53df369bedd967cd4ec4b?width=1100&format=jpeg&auto=webp	osakasa@gmail.com
6	Il giardino di Greta	2.5	1	3.5	Il giardino di Greta is your green paradise. We are highly inspired by the values of the young activist Greta Thunberg, our menu is completely vegan, ecofriendly and we use only local products. Quality is the key point of our cuisine. All the ingredients we use, are chosen according to strict quality criteria!	%ek2%A88pomYv3ryekeu8ooTTM6@5!BA	https://www.cabinetcuriosites.it/wp-content/uploads/2020/01/Colazione-al-Museo-2020-gli-chef-dellAssociazione-Cuochi-alle-prese-col-tema-22LUovo-di-Capodanno22.jpg	giardinoGreta@gmail.com
4	OkeyBab	0	0	1.5	Our little kebab restaurant is open 24 7 to satisfy your hunger at any time! Our quality price ratio is simply unrivalled. Our array of ingredients is so wide and diverse that you probably wont find something like us anywhere else! Give us a try, you will surely come back	S4!cmwGDctNla7fBHgp@51EJQX$WvfX&	https://www.larena.it/image/policy:1.4667048:1456192040/image.jpg?f=16x9&w=1200&$p$f$w=9b37ea6	343 99 59 234
\.


--
-- Name: dishes_code_seq; Type: SEQUENCE SET; Schema: public; Owner: yhqbrujn
--

SELECT pg_catalog.setval('public.dishes_code_seq', 159, true);


--
-- Name: order_items_code_seq; Type: SEQUENCE SET; Schema: public; Owner: yhqbrujn
--

SELECT pg_catalog.setval('public.order_items_code_seq', 99, true);


--
-- Name: orders_code_seq; Type: SEQUENCE SET; Schema: public; Owner: yhqbrujn
--

SELECT pg_catalog.setval('public.orders_code_seq', 63, true);


--
-- Name: cities cities_pkey; Type: CONSTRAINT; Schema: public; Owner: yhqbrujn
--

ALTER TABLE ONLY public.cities
    ADD CONSTRAINT cities_pkey PRIMARY KEY (code);


--
-- Name: dishes dishes_pkey; Type: CONSTRAINT; Schema: public; Owner: yhqbrujn
--

ALTER TABLE ONLY public.dishes
    ADD CONSTRAINT dishes_pkey PRIMARY KEY (code);


--
-- Name: order_items order_items_pkey; Type: CONSTRAINT; Schema: public; Owner: yhqbrujn
--

ALTER TABLE ONLY public.order_items
    ADD CONSTRAINT order_items_pkey PRIMARY KEY (code);


--
-- Name: orders orders_pkey; Type: CONSTRAINT; Schema: public; Owner: yhqbrujn
--

ALTER TABLE ONLY public.orders
    ADD CONSTRAINT orders_pkey PRIMARY KEY (code);


--
-- Name: restaurants restaurants_pkey; Type: CONSTRAINT; Schema: public; Owner: yhqbrujn
--

ALTER TABLE ONLY public.restaurants
    ADD CONSTRAINT restaurants_pkey PRIMARY KEY (code);


--
-- PostgreSQL database dump complete
--

