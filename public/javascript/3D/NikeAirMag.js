import * as THREE from 'three';
import { OrbitControls } from './three.js/examples/jsm/controls/OrbitControls.js';
import { GLTFLoader } from './three.js/examples/jsm/loaders/GLTFLoader.js';
import { EffectComposer } from './three.js/examples/jsm/postprocessing/EffectComposer.js';
import { RenderPass } from './three.js/examples/jsm/postprocessing/RenderPass.js';
import { FilmPass } from './three.js/examples/jsm/postprocessing/FilmPass.js';

document.addEventListener("DOMContentLoaded", function () {

    // GLOBAL
    let scene, camera, renderer, controls, gltfObject, clock;
    const anchorElement = document.getElementById("anchor");
    // init
    function init() {
        scene = new THREE.Scene();
        camera = new THREE.PerspectiveCamera(75, anchorElement.getBoundingClientRect().width / anchorElement.getBoundingClientRect().height, 0.1, 1000);
        renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
        controls = new OrbitControls(camera, renderer.domElement);
        clock = new THREE.Clock();
        // renderer settings
        renderer.setClearColor(0x000000, 0);
        renderer.setSize(anchorElement.getBoundingClientRect().width, anchorElement.getBoundingClientRect().height);
        // camera settings
        camera.position.set(1, 0, 0);
        camera.lookAt(0, 0, 0); // camera looks at the boom's zero

        // controls orbit settings
        controls.minDistance = 9;
        controls.enableZoom = false; // Disable zooming
        controls.minPolarAngle = Math.PI / 2;
        controls.maxPolarAngle = Math.PI / 2;
        controls.update();

        // elements
        var pivot = new THREE.Group();
        const loader = new GLTFLoader().setPath('3D/NikeAirMag/');
        loader.load('NikeAirMag-scene.gltf', function (gltf) {
            gltfObject = gltf.scene;
            gltf.scene.scale.set(8.0, 8.0, 8.0);
            gltfObject.position.z = -4;
            pivot.rotateY(-0.5);

            scene.add(pivot);
            pivot.add(gltfObject);
        });
        const light = new THREE.AmbientLight(0x0d6efd); // soft white light
        scene.add(light);
        const directionalLight = new THREE.DirectionalLight(0xffffff, 1);
        scene.add(directionalLight);
        const directionalLight2 = new THREE.DirectionalLight(0x0d6efd, 1);
        scene.add(directionalLight2);

        // animate
        function animate() {
            // Rotate the loaded object
            if (gltfObject) {
                const time = clock.getElapsedTime();
                gltfObject.position.y = Math.cos(time) * 0.1;
                pivot.rotateY(Math.cos(time) * (-0.001));
            }
            renderer.render(scene, camera);
            composer.render();
        }

        // finish up
        const composer = new EffectComposer(renderer);

        const renderPass = new RenderPass(scene, camera);
        composer.addPass(renderPass);

        const glitchPass = new FilmPass(
            0.35, // noise intensity
            0.6, // scanline intensity
            2048, // scanline count
            false, // grayscale
        );
        composer.addPass(glitchPass);

        anchorElement.appendChild(renderer.domElement);
        renderer.setAnimationLoop(animate);
    }

    init();

    function onWindowResize() {
        camera.aspect = anchorElement.getBoundingClientRect().width / anchorElement.getBoundingClientRect().height;
        camera.updateProjectionMatrix();
        renderer.setSize(anchorElement.getBoundingClientRect().width, anchorElement.getBoundingClientRect().height);
    }
    window.addEventListener("resize", onWindowResize, false);
});